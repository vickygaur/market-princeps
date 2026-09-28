<script>
    const contactLeadStoreUrl = @json(route('leads.store'));

    function updateCategoryRadios(input) {
        document.querySelectorAll('#categoryRadioGroup label').forEach(lbl => {
            lbl.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-sm');
            lbl.classList.add('bg-surface-container', 'text-on-surface');
        });
        const activeLabel = input.closest('label');
        if (activeLabel) {
            activeLabel.classList.remove('bg-surface-container', 'text-on-surface');
            activeLabel.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm');
        }
    }

    function toggleAccordion(button) {
        const answer = button.parentElement.querySelector('.faq-answer');
        const icon = button.querySelector('.material-symbols-outlined');
        const isExpanded = answer && !answer.classList.contains('hidden');

        document.querySelectorAll('#faqAccordion .faq-answer').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('#faqAccordion button[aria-expanded]').forEach(btn => btn.setAttribute('aria-expanded', 'false'));
        document.querySelectorAll('#faqAccordion .material-symbols-outlined').forEach(el => {
            el.innerText = 'expand_more';
        });

        if (!isExpanded && answer) {
            answer.classList.remove('hidden');
            button.setAttribute('aria-expanded', 'true');
            if (icon) {
                icon.innerText = 'expand_less';
            }
        }
    }

    async function handleContactLeadSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const err = document.getElementById('contact-form-error');
        const toast = document.getElementById('successToast');
        const submitBtn = document.getElementById('contact-submit-btn');

        if (err) {
            err.classList.add('hidden');
            err.innerText = '';
        }
        if (toast) {
            toast.classList.add('hidden');
        }

        const formData = new FormData(form);
        const payload = Object.fromEntries(formData.entries());

        if (submitBtn) {
            submitBtn.disabled = true;
        }

        try {
            const response = await fetch(contactLeadStoreUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                const message = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Something went wrong. Please try again.');
                if (err) {
                    err.innerText = message;
                    err.classList.remove('hidden');
                }
                return;
            }

            form.reset();
            const marketingRadio = form.querySelector('input[name="help_category"][value="marketing"]');
            if (marketingRadio) {
                marketingRadio.checked = true;
                updateCategoryRadios(marketingRadio);
            }

            const sourceInput = form.querySelector('input[name="source"]');
            if (sourceInput) {
                sourceInput.value = 'contact';
            }

            if (toast) {
                toast.classList.remove('hidden');
                toast.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        } catch (error) {
            if (err) {
                err.innerText = 'Network error. Please try again.';
                err.classList.remove('hidden');
            }
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
            }
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('contact-lead-form');
        if (form) {
            form.addEventListener('submit', handleContactLeadSubmit);
        }
    });
</script>
