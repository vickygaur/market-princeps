<script>
    const serviceLeadStoreUrl = @json(route('leads.store'));

    function selectPillarTab(targetId, el) {
        const buttons = document.querySelectorAll('.pillar-btn');
        const panels = document.querySelectorAll('.pillar-panel');

        buttons.forEach(btn => {
            btn.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-md', 'border-primary-container');
            btn.classList.add('bg-surface-container-low', 'hover:bg-surface-container', 'text-on-surface', 'border-outline-variant/30');
            const badge = btn.querySelector('.pillar-badge');
            if (badge) {
                badge.classList.remove('text-secondary-container');
                badge.classList.add('text-secondary');
            }
            const icon = btn.querySelector('.material-symbols-outlined');
            if (icon) {
                icon.classList.remove('text-secondary-container');
                icon.classList.add('text-secondary');
            }
        });

        el.classList.remove('bg-surface-container-low', 'hover:bg-surface-container', 'text-on-surface', 'border-outline-variant/30');
        el.classList.add('bg-primary-container', 'text-on-primary', 'shadow-md', 'border-primary-container');

        const activeBadge = el.querySelector('.pillar-badge');
        if (activeBadge) {
            activeBadge.classList.remove('text-secondary');
            activeBadge.classList.add('text-secondary-container');
        }
        const activeIcon = el.querySelector('.material-symbols-outlined');
        if (activeIcon) {
            activeIcon.classList.remove('text-secondary');
            activeIcon.classList.add('text-secondary-container');
        }

        panels.forEach(panel => {
            if (panel.id === targetId) {
                panel.classList.remove('hidden');
                panel.classList.add('flex');
            } else {
                panel.classList.add('hidden');
                panel.classList.remove('flex');
            }
        });
    }

    function initServiceFaq() {
        document.querySelectorAll('.faq-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const body = btn.nextElementSibling;
                const icon = btn.querySelector('.faq-icon');
                const isOpen = body && !body.classList.contains('hidden');

                document.querySelectorAll('.faq-body').forEach(b => b.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180'));

                if (!isOpen && body) {
                    body.classList.remove('hidden');
                    if (icon) {
                        icon.classList.add('rotate-180');
                    }
                }
            });
        });
    }

    function initPillarTabs() {
        document.querySelectorAll('.pillar-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-target');
                if (targetId) {
                    selectPillarTab(targetId, btn);
                }
            });
        });
    }

    async function handleServiceLeadSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const err = document.getElementById('service-form-error');
        const success = document.getElementById('service-form-success');
        const submitBtn = document.getElementById('service-lead-submit');

        if (err) {
            err.classList.add('hidden');
            err.textContent = '';
        }
        if (success) {
            success.classList.add('hidden');
        }

        const formData = new FormData(form);
        const payload = Object.fromEntries(formData.entries());

        if (submitBtn) {
            submitBtn.disabled = true;
        }

        try {
            const response = await fetch(serviceLeadStoreUrl, {
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
                    err.textContent = message;
                    err.classList.remove('hidden');
                }
                return;
            }

            form.reset();
            const sourceInput = form.querySelector('input[name="source"]');
            const helpInput = form.querySelector('input[name="help_category"]');
            if (sourceInput) {
                sourceInput.value = @json('service:'.$service->slug);
            }
            if (helpInput) {
                helpInput.value = @json(data_get($content, 'intake.help_category', 'marketing'));
            }

            if (success) {
                success.textContent = data.message || 'Thank you. We received your message and will be in touch soon.';
                success.classList.remove('hidden');
                success.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        } catch (error) {
            if (err) {
                err.textContent = 'Network error. Please try again.';
                err.classList.remove('hidden');
            }
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
            }
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        initPillarTabs();
        initServiceFaq();

        const form = document.getElementById('service-lead-form');
        if (form) {
            form.addEventListener('submit', handleServiceLeadSubmit);
        }
    });
</script>
