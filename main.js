
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
    ev.preventDefault();
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
    if (ok) alert('Форма дұрыс толтырылған! (Серверге жіберу 10–11 аптада қосылады)');
  });
});

const list = document.getElementById('bookList');
if (list) {
  const q = document.getElementById('q');
  const genre = document.getElementById('genre');
  const sort = document.getElementById('sort');
  const empty = document.getElementById('empty');
  const count = document.getElementById('count');
  const cards = [...list.querySelectorAll('.book')];

  function apply() {
    const text = q.value.trim().toLowerCase();
    let shown = cards.filter(c => {
      const t = (c.dataset.title + ' ' + c.dataset.author).toLowerCase();
      return t.includes(text) && (genre.value === '' || c.dataset.genre === genre.value);
    });
    shown.sort((a, b) => {
      if (sort.value === 'year') return b.dataset.year - a.dataset.year;
      return a.dataset[sort.value].localeCompare(b.dataset[sort.value], 'kk');
    });
    cards.forEach(c => c.style.display = 'none');
    shown.forEach(c => { c.style.display = ''; list.appendChild(c); });
    empty.style.display = shown.length ? 'none' : 'block';
    count.textContent = shown.length;
  }
  [q, genre, sort].forEach(el => el.addEventListener('input', apply));
  document.getElementById('reset').addEventListener('click', () => {
    q.value = ''; genre.value = ''; sort.value = 'title'; apply();
  });
  apply();
}
