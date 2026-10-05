(function(){
  'use strict';
  const body=document.body;
  const header=document.getElementById('site-header');
  const toggle=document.querySelector('.menu-toggle');
  const nav=document.getElementById('primary-menu');
  const backdrop=document.querySelector('.nav-backdrop');
  const closeEls=document.querySelectorAll('[data-menu-close]');
  if(header){
    const onScroll=()=>header.classList.toggle('is-scrolled',window.scrollY>20);
    onScroll(); window.addEventListener('scroll',onScroll,{passive:true});
  }
  function openMenu(){
    if(!nav||!toggle)return;
    nav.classList.add('is-open');
    backdrop&&backdrop.classList.add('is-visible');
    body.classList.add('menu-open');
    toggle.setAttribute('aria-expanded','true');
    toggle.setAttribute('aria-label','Close menu');
    nav.setAttribute('aria-hidden','false');
    const first=nav.querySelector('a'); if(first) setTimeout(()=>first.focus(),220);
  }
  function closeMenu(){
    if(!nav||!toggle)return;
    nav.classList.remove('is-open');
    backdrop&&backdrop.classList.remove('is-visible');
    body.classList.remove('menu-open');
    toggle.setAttribute('aria-expanded','false');
    toggle.setAttribute('aria-label','Open menu');
    nav.setAttribute('aria-hidden','true');
  }
  toggle&&toggle.addEventListener('click',()=>nav.classList.contains('is-open')?closeMenu():openMenu());
  closeEls.forEach(el=>el.addEventListener('click',closeMenu));
  nav&&nav.addEventListener('click',e=>{if(e.target.closest('a'))closeMenu();});
  document.addEventListener('keydown',e=>{if(e.key==='Escape')closeMenu();});

  const observer=new IntersectionObserver((entries)=>entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.add('is-visible');observer.unobserve(entry.target);}}),{threshold:.12});
  document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));
})();
