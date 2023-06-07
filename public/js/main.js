//клик по элементу открыть/закрыть

let openClouse = document.querySelector('.action-open-close .button');

openClouse.addEventListener("click",
    function (event) {
        let aoc = this.closest('.action-open-close');
        aoc.classList.toggle('open');
        let button = aoc.querySelector('.button');
        if(aoc.classList.contains('open'))
        {
            button.innerHTML = 'Закрыть';
        }else{
            button.innerHTML = 'Открыть';
        }

    }
);
