<h1>Карта рукописи</h1>
<style>
.treeCSS, 
.treeCSS ul,
.treeCSS li {
  margin: 0;
  padding: 0;
  line-height: 1;
  list-style: none;
}
.treeCSS ul {
  margin: 0 0 0 60px; /* вести линию вниз где-то с полбуквы родителя */
}
.treeCSS > li:not(:only-child),
.treeCSS li li {
  position: relative;
  padding: .2em 0 0 1.2em; /* отступ до текста; для раскрывающегося списка в ряде случаев (в Хроме есть баг) padding-top (.2em) лучше указывать в px */
}
.treeCSS li:not(:last-child) {
  border-left: 1px solid #ccc; /* толщина, цвет и стиль (вместо сплошной пунктирная или точечная) вертикальной линии */
}
.treeCSS li li:before,
.treeCSS > li:not(:only-child):before { /* горизонтальная линия */
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 1.1em; /* не более отступа до текста (1.2em) */
  height: .7em; /* начинается приблизительно с половины высоты буквы (.5em + .2em) */
  border-bottom: 1px solid #ccc;
}
.treeCSS li:last-child:before { /* вертикальная линия последнего пункта в каждом списке */
  width: calc(1.1em - 1px); /* для перфекционистов */
  border-left: 1px solid #ccc;
}
.treeCSS .description{
    background-color: #F5FFFA;
    padding: 10px;
    border:1px solid #708090;
    opacity:0.6;
    margin-top: 10px;
}
.treeCSS .textBold{
    font-weight: bold;
}
</style>
<?
print_r($map);?>