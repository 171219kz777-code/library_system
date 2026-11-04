const menuBtn = document.getElementById('menuBtn');
const menu = document.getElementById('menu');
if (menuBtn && menu) {
  menuBtn.addEventListener('click', () => {
    const open = menu.classList.toggle('open');
    menuBtn.setAttribute('aria-expanded', open);
  });
}

document.querySelectorAll('.pw-toggle').forEach(btn => {
  btn.addEventListener('click', () => {
    const input = btn.parentElement.querySelector('input');
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    btn.textContent = show ? 'Жасыру' : 'Көрсету';
  });
});

function showError(input, message) {
  input.classList.toggle('invalid', !!message);
  const err = input.closest('label').querySelector('.field-error');
  if (err) { err.textContent = message || ''; err.style.display = message ? 'block' : 'none'; }
}
const rules = {
  name: v => v.trim().length < 2 ? 'Аты кемінде 2 таңба болуы керек' : '',
  email: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) ? '' : 'Email дұрыс емес',
  password: v => v.length < 6 ? 'Пароль кемінде 6 таңба болуы керек' : '',
};
document.querySelectorAll('form[data-validate]').forEach(form => {
  form.addEventListener('submit', ev => {
    let ok = true;
    form.querySelectorAll('input').forEach(input => {
      let msg = rules[input.name] ? rules[input.name](input.value) : '';
      if (input.name === 'password2') {
        const pw = form.querySelector('[name=password]').value;
        msg = input.value !== pw ? 'Парольдер сәйкес емес' : '';
      }
      showError(input, msg);
      if (msg) ok = false;
    });
    if (!ok) ev.preventDefault(); // қате болмаса форма серверге (PHP) жіберіледі
  });
});

