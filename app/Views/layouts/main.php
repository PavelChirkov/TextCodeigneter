<!DOCTYPE html>
<html>

<head>
  <title>Программа для писателей | <?= $this->renderSection('title') ?></title>
  <link rel="stylesheet" type="text/css" href="/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/themes/default.min.css" />
  <script src="/js/sceditor.min.js"></script>

</head>

<body>
  <header>
    <nav>
      <ul class="menu-main">
         <li><a href="/cabinet" class="current">Рукописи</a></li>
         <li><a href="/cabinet/user">Настройки пользователя</a></li>
         <li><a href="">Blog</a></li>
         <li><a href="">Выход</a></li>
      </ul>
  </header>

  <main>

    <h1><?= $this->renderSection('title') ?></h1>

    <?= $this->renderSection('content') ?>

  </main>

  <script>
    var textareas = document.querySelectorAll('.wsws');
    for (const textarea of textareas) {
      sceditor.create(textarea, {
        format: 'xhtml',
        toolbar: 'bold,italic,underline|left,center,right,justify|font,size,color|source',
        style: '/themes/content/default.min.css',
        width: '100%'
      });
    }
  </script>
  <script src="/js/main.js"></script>
  <script>
    class ItcTabs {
      constructor(target, config) {
        const defaultConfig = {};
        this._config = Object.assign(defaultConfig, config);
        this._elTabs = typeof target === 'string' ? document.querySelector(target) : target;
        this._elButtons = this._elTabs.querySelectorAll('.tabs__btn');
        this._elPanes = this._elTabs.querySelectorAll('.tabs__pane');
        this._eventShow = new Event('tab.itc.change');
        this._init();
        this._events();
      }
      _init() {
        this._elTabs.setAttribute('role', 'tablist');
        this._elButtons.forEach((el, index) => {
          el.dataset.index = index;
          el.setAttribute('role', 'tab');
          this._elPanes[index].setAttribute('role', 'tabpanel');
        });
      }
      show(elLinkTarget) {
        const elPaneTarget = this._elPanes[elLinkTarget.dataset.index];
        const elLinkActive = this._elTabs.querySelector('.tabs__btn_active');
        const elPaneShow = this._elTabs.querySelector('.tabs__pane_show');
        if (elLinkTarget === elLinkActive) {
          return;
        }
        elLinkActive ? elLinkActive.classList.remove('tabs__btn_active') : null;
        elPaneShow ? elPaneShow.classList.remove('tabs__pane_show') : null;
        elLinkTarget.classList.add('tabs__btn_active');
        elPaneTarget.classList.add('tabs__pane_show');
        this._elTabs.dispatchEvent(this._eventShow);
        elLinkTarget.focus();
      }
      showByIndex(index) {
        const elLinkTarget = this._elButtons[index];
        elLinkTarget ? this.show(elLinkTarget) : null;
      };
      _events() {
        this._elTabs.addEventListener('click', (e) => {
          const target = e.target.closest('.tabs__btn');
          if (target) {
            e.preventDefault();
            this.show(target);
          }
        });
      }
    }

    // инициализация .tabs как табов
    new ItcTabs('.tabs');
  </script>





</body>

</html>