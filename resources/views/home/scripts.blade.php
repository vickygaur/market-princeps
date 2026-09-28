@php
    $heroSection = $sections['hero'] ?? [];
    $triadSection = $sections['triad'] ?? [];

    $defaultHeroConsoleData = [
        'attract' => [
            'subhead' => 'STAGE 01 // DEMAND & MARKET CAPTURE',
            'status' => 'ATTRACTING ELITE DEMAND // AWARENESS → ENGAGEMENT → QUALIFIED PIPELINE',
            'cards' => [
                ['tag' => 'REACH', 'title' => 'Precision Authority Inflow', 'desc' => 'Target high-intent institutional buyers through verified executive distribution.'],
                ['tag' => 'POSITIONING', 'title' => 'Irrefutable Strategic Framing', 'desc' => 'Command immediate distinction from generic agencies and commodity services.'],
                ['tag' => 'TOUCHPOINTS', 'title' => 'Diagnostic Interactive Portals', 'desc' => 'Engage buyers through proprietary diagnostic tools and custom assessments.'],
                ['tag' => 'DEMAND', 'title' => 'Pre-Vetted Inbound Mesh', 'desc' => 'Systematically filter unqualified noise; deliver ready-to-close dossiers.'],
            ],
        ],
        'convert' => [
            'subhead' => 'STAGE 02 // VELOCITY & COMMERCIAL CONVERSION',
            'status' => 'FRICTIONLESS CONVERSION // VERIFICATION → VELOCITY → CONTRACTED CAPITAL',
            'cards' => [
                ['tag' => 'VELOCITY', 'title' => 'Automated Executive Briefings', 'desc' => 'Eliminate sales friction with real-time, customized executive dossiers.'],
                ['tag' => 'PROOF', 'title' => 'Institutional ROI Telemetry', 'desc' => 'Demonstrate operational math and clear net-margin expansion before signing.'],
                ['tag' => 'GOVERNANCE', 'title' => 'Frictionless Onboarding', 'desc' => 'Automate mutual NDAs, master agreements, and secure client payment portals.'],
                ['tag' => 'CAPITAL', 'title' => 'Accelerated Contract Value', 'desc' => 'Compress enterprise sales cycles from months to days with high-trust systems.'],
            ],
        ],
        'optimize' => [
            'subhead' => 'STAGE 03 // EBITDA MULTIPLIER & COMPOUNDING SCALE',
            'status' => 'COMPOUNDING SCALE // RETENTION → MARGIN EXPANSION → ENTERPRISE EQUITY',
            'cards' => [
                ['tag' => 'INTEGRATION', 'title' => 'Custom Middleware & ERP Sync', 'desc' => 'Connect CRM, delivery pipelines, and client portals with zero manual drag.'],
                ['tag' => 'MARGIN', 'title' => 'Headcount Overhead Elimination', 'desc' => 'Scale client volume 3x without hiring additional account managers or coordinators.'],
                ['tag' => 'EXPANSION', 'title' => 'Algorithmic Account Retention', 'desc' => 'Automate SLA monitoring, predictive renewals, and organic expansion triggers.'],
                ['tag' => 'SOVEREIGNTY', 'title' => 'Enterprise Valuation Multiplier', 'desc' => 'Build compounding enterprise value backed by proprietary technological assets.'],
            ],
        ],
    ];

    $defaultTriadData = [
        'p1' => [
            'badge' => 'PILLAR 01 // PRECISION ACQUISITION MESH',
            'title' => 'Attracting high-value institutional buyers while systematically eliminating unqualified noise.',
            'desc' => 'We construct custom intent-scoring scrapers, private executive briefings, and automated gating mechanisms. Leads are not dumped into a chaotic mailbox; they are algorithmic dossiers delivered directly to your senior decision-makers ready to close.',
            'm1Val' => '92.4% Institutional',
            'm2Val' => '-41.8% Net Spend',
            'telemetry' => 'Telemetry 28.4% Conv',
            'flowLabel' => 'marketing flow',
            'cta' => 'EXPLORE MARKETING',
            'stages' => [
                ['n' => '1', 'name' => 'Category Authority Gateway', 'val' => '8,400 Imp'],
                ['n' => '2', 'name' => 'Diagnostic Intake & Dossier', 'val' => '412 Submits'],
                ['n' => '3', 'name' => 'Sovereign Partner Briefing', 'val' => '64 Closed'],
            ],
        ],
        'p2' => [
            'badge' => 'PILLAR 02 // BUSINESS TECH & CUSTOM ERP',
            'title' => 'Replacing 8 scattered SaaS subscriptions with one singular, ultra-responsive operational command center.',
            'desc' => 'Custom engineered web portals and database schemas tailored specifically to your exact service delivery rules. Eliminate human data-entry bottlenecks, automate partner reporting, and establish total system auditability.',
            'm1Val' => '100% In-House Code',
            'm2Val' => '76% Zero-Touch',
            'telemetry' => 'System SLA 99.99%',
            'flowLabel' => 'technology flow',
            'cta' => 'EXPLORE TECHNOLOGY',
            'stages' => [
                ['n' => '1', 'name' => 'Unified Relational Database', 'val' => '0 Redundancies'],
                ['n' => '2', 'name' => 'Automated Account Provisioning', 'val' => '0.8s Execution'],
                ['n' => '3', 'name' => 'Real-Time Financial Ledger', 'val' => 'Live Sync'],
            ],
        ],
        'p3' => [
            'badge' => 'PILLAR 03 // OPERATIONAL MULTIPLIER',
            'title' => 'Decoupling revenue expansion from linear operator hiring, safeguarding net margins.',
            'desc' => 'When delivery processes run through engineered pipelines rather than memory and spreadsheets, 10x volume requires 0x additional administrative heads. Net margin flows directly to retained enterprise value.',
            'm1Val' => '+44.2% EBITDA',
            'm2Val' => '< 0.05% Error Mesh',
            'telemetry' => 'Scale Velocity 4.2x',
            'flowLabel' => 'optimization flow',
            'cta' => 'EXPLORE OPTIMIZATION',
            'stages' => [
                ['n' => '1', 'name' => 'Automated SLA Routing', 'val' => 'Instant'],
                ['n' => '2', 'name' => 'Vendor & Resource Dispatch', 'val' => 'Dynamic AI'],
                ['n' => '3', 'name' => 'Capital Retention Matrix', 'val' => '+38% Margin'],
            ],
        ],
    ];

    $heroConsoleData = array_replace_recursive($defaultHeroConsoleData, data_get($heroSection, 'console_modes', []));
    $triadData = array_replace_recursive($defaultTriadData, data_get($triadSection, 'pillars', []));
@endphp
<script>
    const heroConsoleData = @json($heroConsoleData);
    const triadData = @json($triadData);
    const leadStoreUrl = @json(route('leads.store'));
    const newsletterSubscribeUrl = @json(route('newsletter.subscribe'));

    function setHeroMode(mode) {
      const tabs = ['attract', 'convert', 'optimize'];
      tabs.forEach(t => {
        const btn = document.getElementById('tab-' + t);
        if (!btn) return;
        if (t === mode) {
          btn.className = 'px-space-md py-1.5 rounded text-xs font-label-md transition-all bg-primary-container text-on-primary shadow-sm font-semibold';
        } else {
          btn.className = 'px-space-md py-1.5 rounded text-xs font-label-md transition-all text-on-surface-variant hover:text-on-surface font-semibold';
        }
      });

      const data = heroConsoleData[mode];
      if (!data) return;

      const subheadEl = document.getElementById('hero-subhead');
      const statusEl = document.getElementById('hero-status-tag');
      if (subheadEl) subheadEl.innerText = data.subhead;
      if (statusEl) statusEl.innerText = data.status;

      (data.cards || []).forEach((c, idx) => {
        const nodeNum = idx + 1;
        const tagEl = document.getElementById(`node${nodeNum}-tag`);
        const titleEl = document.getElementById(`node${nodeNum}-title`);
        const descEl = document.getElementById(`node${nodeNum}-desc`);

        if (tagEl) tagEl.innerText = c.tag;
        if (titleEl) titleEl.innerText = c.title;
        if (descEl) descEl.innerText = c.desc;
      });
    }

    function switchTriad(pillar) {
      const b1 = document.getElementById('btn-p1');
      const b2 = document.getElementById('btn-p2');
      const b3 = document.getElementById('btn-p3');

      [b1, b2, b3].forEach(b => {
        if (!b) return;
        b.className = 'px-space-lg py-2.5 rounded-lg text-label-md font-label-md font-semibold transition-all text-on-surface-variant hover:text-on-surface flex items-center gap-space-sm card-hover-elevate';
      });

      const currentBtn = document.getElementById('btn-' + pillar);
      if (currentBtn) {
        currentBtn.className = 'px-space-lg py-2.5 rounded-lg text-label-md font-label-md font-semibold transition-all bg-primary-container text-on-primary shadow-sm flex items-center gap-space-sm card-hover-elevate';
      }

      const data = triadData[pillar];
      if (!data) return;

      const setText = (id, val) => {
        const el = document.getElementById(id);
        if (el && val !== undefined) el.innerText = val;
      };

      setText('triad-badge', data.badge);
      setText('triad-title', data.title);
      setText('triad-desc', data.desc);
      setText('triad-metric-1', data.m1Val);
      setText('triad-metric-2', data.m2Val);
      setText('triad-telemetry', data.telemetry);
      setText('triad-flow-label', data.flowLabel);

      const cta = document.getElementById('triad-cta');
      if (cta && data.cta) {
        const span = cta.querySelector('span');
        if (span) span.innerText = data.cta;
      }

      const stagesContainer = document.getElementById('triad-flow-stages');
      if (stagesContainer && data.stages) {
        stagesContainer.innerHTML = data.stages.map((s, idx) => `
        <div class="p-space-sm rounded-lg ${idx === 2 ? 'bg-secondary-container/20' : 'bg-surface-container-high/10'} flex items-center justify-between transition-all hover:bg-surface-container-high/20">
          <div class="flex items-center gap-space-sm">
            <span class="w-6 h-6 rounded-full bg-secondary-container text-on-secondary-fixed flex items-center justify-center text-xs font-bold">${s.n}</span>
            <span class="font-title-md text-body-md text-on-primary ${idx === 2 ? 'font-semibold' : ''}">${s.name}</span>
          </div>
          <span class="font-label-caps text-label-caps ${idx === 2 ? 'text-secondary-container font-bold' : 'text-secondary-fixed'}">${s.val}</span>
        </div>
      `).join('');
      }
    }

    function formatINR(val) {
      if (isNaN(val)) return '₹0';
      return '₹' + Math.round(val).toLocaleString('en-IN');
    }

    function syncManualToRevenue(val) {
      const manualVal = Math.min(100, Math.max(0, parseFloat(val) || 0));
      const revRange = document.getElementById('tools-range');
      if (revRange) {
        revRange.value = Math.max(0, 100 - manualVal);
      }
      calculateSimulator();
    }

    function syncRevenueToManual(val) {
      const revVal = Math.min(100, Math.max(0, parseFloat(val) || 0));
      const manualRange = document.getElementById('spend-range');
      if (manualRange) {
        manualRange.value = Math.max(0, 100 - revVal);
      }
      calculateSimulator();
    }

    function calculateSimulator() {
      const empInput = document.getElementById('employees-range');
      const manualInput = document.getElementById('spend-range');
      const revWorkInput = document.getElementById('tools-range');
      const teamCostInput = document.getElementById('team-range');
      const revInput = document.getElementById('revenue-input');

      if (!empInput || !manualInput || !revWorkInput || !revInput) return;

      const emp = parseFloat(empInput.value) || 0;
      const manualPercent = parseFloat(manualInput.value) || 0;
      const revPercent = parseFloat(revWorkInput.value) || 0;
      const resourceSalary = teamCostInput ? (parseFloat(teamCostInput.value) || 50000) : 50000;
      const monthlyRev = parseFloat(String(revInput.value).replace(/[^0-9.]/g, '')) || 0;

      const empDisplay = document.getElementById('employees-display');
      if (empDisplay) empDisplay.innerText = emp + (emp === 1 ? ' team member' : ' team members');
      const spendDisplay = document.getElementById('spend-display');
      if (spendDisplay) spendDisplay.innerText = manualPercent + '%';
      const toolsDisplay = document.getElementById('tools-display');
      if (toolsDisplay) toolsDisplay.innerText = revPercent + '%';
      const teamDisplay = document.getElementById('team-display');
      if (teamDisplay) teamDisplay.innerText = formatINR(resourceSalary);
      const revDisplay = document.getElementById('revenue-display');
      if (revDisplay) revDisplay.innerText = formatINR(monthlyRev) + ' / mo';

      const totalTeamHours = emp * 160;
      const totalManualHours = totalTeamHours * (manualPercent / 100);
      const totalProductiveHours = totalTeamHours * (revPercent / 100);
      const unlockedHours = totalManualHours * 0.50;

      const hoursEl = document.getElementById('sim-hours');
      if (hoursEl) {
        const roundedUnlocked = Math.round(unlockedHours * 10) / 10;
        hoursEl.innerText = (roundedUnlocked % 1 === 0 ? roundedUnlocked.toFixed(0) : roundedUnlocked.toFixed(1)) + ' hrs / month';
      }

      let additionalRevenue = 0;
      let growthPercent = 0;

      if (totalProductiveHours > 0) {
        const revPerProductiveHour = monthlyRev / totalProductiveHours;
        additionalRevenue = unlockedHours * revPerProductiveHour;
        growthPercent = monthlyRev > 0 ? (additionalRevenue / monthlyRev) * 100 : ((unlockedHours / totalProductiveHours) * 100);
      } else if (unlockedHours > 0) {
        additionalRevenue = unlockedHours * (resourceSalary / 160);
        growthPercent = monthlyRev > 0 ? (additionalRevenue / monthlyRev) * 100 : 0;
      }

      const capacityEl = document.getElementById('sim-capacity');
      if (capacityEl) {
        const roundedGrowth = Math.round(growthPercent * 10) / 10;
        const growthFormatted = roundedGrowth % 1 === 0 ? roundedGrowth.toFixed(0) : roundedGrowth.toFixed(1);
        capacityEl.innerText = '+' + growthFormatted + '%';
      }

      const modeledRev = Math.round(monthlyRev + additionalRevenue);
      const modeledEl = document.getElementById('sim-modeled');
      if (modeledEl) {
        modeledEl.innerText = formatINR(modeledRev) + ' / month';
      }
    }

    async function handleAuditSubmit(e) {
      e.preventDefault();
      const form = e.target;
      const fb = document.getElementById('form-feedback');
      const err = document.getElementById('form-error');
      const btn = document.getElementById('btn-submit-audit');
      const label = document.getElementById('btn-submit-audit-label');

      if (err) {
        err.classList.add('hidden');
        err.innerText = '';
      }

      const formData = new FormData(form);
      const payload = Object.fromEntries(formData.entries());

      if (btn) btn.disabled = true;

      try {
        const response = await fetch(leadStoreUrl, {
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

        if (label) label.innerText = 'Message received';
        if (btn) {
          btn.classList.add('opacity-90');
        }
        if (fb) {
          fb.innerText = data.message || fb.dataset.successMessage || 'Thank you.';
          fb.classList.remove('hidden');
        }
        form.reset();
        const marketingRadio = form.querySelector('input[name="help_category"][value="marketing"]');
        if (marketingRadio) marketingRadio.checked = true;
      } catch (error) {
        if (err) {
          err.innerText = 'Network error. Please try again.';
          err.classList.remove('hidden');
        }
      } finally {
        if (btn) btn.disabled = false;
      }
    }

    async function handleNewsletterSubmit(e) {
      e.preventDefault();
      const form = e.target;
      const feedback = document.getElementById('newsletter-feedback');
      const submitBtn = form.querySelector('button[type="submit"]');

      if (submitBtn) submitBtn.disabled = true;

      try {
        const response = await fetch(newsletterSubscribeUrl, {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
          },
          body: JSON.stringify({ email: form.email.value }),
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
          const message = data.message || (data.errors?.email ? data.errors.email[0] : 'Unable to subscribe.');
          if (feedback) {
            feedback.innerText = message;
            feedback.classList.remove('hidden');
            feedback.classList.add('text-on-tertiary-container');
          }
          return;
        }

        form.reset();
        if (feedback) {
          feedback.innerText = data.message || 'Subscribed successfully.';
          feedback.classList.remove('hidden');
        }
      } catch (error) {
        if (feedback) {
          feedback.innerText = 'Network error. Please try again.';
          feedback.classList.remove('hidden');
        }
      } finally {
        if (submitBtn) submitBtn.disabled = false;
      }
    }

    window.addEventListener('DOMContentLoaded', () => {
      calculateSimulator();

      const leadForm = document.getElementById('lead-form');
      if (leadForm) {
        leadForm.addEventListener('submit', handleAuditSubmit);
      }

      const newsletterForm = document.getElementById('newsletter-form');
      if (newsletterForm) {
        newsletterForm.addEventListener('submit', handleNewsletterSubmit);
      }
    });
</script>
