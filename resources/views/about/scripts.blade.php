<script>
document.addEventListener('DOMContentLoaded', () => {
  const revealElements = document.querySelectorAll('.reveal-init');
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (!prefersReducedMotion) {
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('reveal-visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    revealElements.forEach(el => observer.observe(el));
  } else {
    revealElements.forEach(el => el.classList.add('reveal-visible'));
  }

  const canvas = document.getElementById('hero-particle-canvas');
  if (canvas && !prefersReducedMotion) {
    const ctx = canvas.getContext('2d');
    let width, height;
    const particles = [];
    const particleCount = 22;

    const resize = () => {
      const parent = canvas.parentElement;
      width = canvas.width = parent.offsetWidth;
      height = canvas.height = parent.offsetHeight;
    };
    resize();
    window.addEventListener('resize', resize, { passive: true });

    for (let i = 0; i < particleCount; i++) {
      particles.push({
        x: Math.random() * width,
        y: Math.random() * height,
        r: Math.random() * 2 + 1,
        speedX: (Math.random() - 0.5) * 0.35,
        speedY: (Math.random() - 0.5) * 0.35,
        alpha: Math.random() * 0.5 + 0.15
      });
    }

    let animationFrameId;
    const render = () => {
      ctx.clearRect(0, 0, width, height);
      for (let i = 0; i < particles.length; i++) {
        const p = particles[i];
        p.x += p.speedX;
        p.y += p.speedY;

        if (p.x < 0) p.x = width;
        if (p.x > width) p.x = 0;
        if (p.y < 0) p.y = height;
        if (p.y > height) p.y = 0;

        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(254, 147, 44, ${p.alpha})`;
        ctx.fill();
      }
      animationFrameId = requestAnimationFrame(render);
    };
    render();
  }

  const codexItems = document.querySelectorAll('.codex-item');
  codexItems.forEach(item => {
    item.addEventListener('click', () => {
      codexItems.forEach(el => {
        el.classList.remove('codex-active', 'border-secondary-container/40');
        el.classList.add('border-transparent');
        const num = el.querySelector('.codex-num');
        if (num) { num.classList.remove('text-secondary-container'); num.classList.add('text-on-primary-container'); }
        const arrow = el.querySelector('.codex-arrow');
        if (arrow) { arrow.classList.remove('rotate-90', 'text-secondary-container'); arrow.classList.add('text-on-primary-container'); }
        const desc = el.querySelector('.codex-desc');
        if (desc) desc.classList.add('hidden');
      });
      item.classList.add('codex-active', 'border-secondary-container/40');
      item.classList.remove('border-transparent');
      const activeNum = item.querySelector('.codex-num');
      if (activeNum) { activeNum.classList.add('text-secondary-container'); activeNum.classList.remove('text-on-primary-container'); }
      const activeArrow = item.querySelector('.codex-arrow');
      if (activeArrow) { activeArrow.classList.add('rotate-90', 'text-secondary-container'); activeArrow.classList.remove('text-on-primary-container'); }
      const activeDesc = item.querySelector('.codex-desc');
      if (activeDesc) activeDesc.classList.remove('hidden');
    });
  });
});
</script>
