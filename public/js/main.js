//клик по элементу открыть/закрыть

let openClouse = document.querySelector('.action-open-close .button');
openClouse.addEventListener("click",
    function (event) {
        let aoc = this.closest('.action-open-close');
        aoc.classList.toggle('open');
        let button = aoc.querySelector('.button');
        if (aoc.classList.contains('open')) {
            button.innerHTML = 'Закрыть';
        } else {
            button.innerHTML = 'Открыть';
        }

    }
);


let openEdit = document.querySelectorAll('.edit-text');

for (const button of openEdit) {
    button.addEventListener('click', function (event) {
        let aoc = this.closest('.text');
        let et = aoc.querySelector('.inner');
        et.style.display = "none";
        let ef = aoc.querySelector('.edit-form');
        ef.style.display = "block";
    });
}


function AjaxFormSendEVN(element,hideElement,showelEment){

    var form = document.querySelector(element);

    form.addEventListener("submit", function (e) {

        e.preventDefault();
        let me = this;
        var form = e.target;
        var data = new FormData(form);
    
        var request = new XMLHttpRequest();


        /*request.responseType = 'json';*/
        request.open(form.method, form.action);
        request.send(data);

        /*request.onreadystatechange = function () {
            if(request.status == "200"){
               
                 let aoc = me.closest(hideElement);
                 aoc.style.display = "none";

                 let mds = aoc.closest('.text');
                 let tti = mds.querySelector(showelEment);
                 tti.style.display = "block";

                 alert(request.responseText);
            }
         }*/
        request.onload = function() {
            let rsd =  request.responseText;

            let aoc = me.closest(hideElement);
            aoc.style.display = "none";

            let mds = aoc.closest('.text');
            let tti = mds.querySelector(showelEment);
            tti.style.display = "block";
            tti.innerHTML = rsd;
            
        };

    });

}

AjaxFormSendEVN('.ajaxForm','.edit-form','.inner');


