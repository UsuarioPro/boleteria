const tabsBox = document.querySelector(".tabs-box_opc"),
allTabs = tabsBox.querySelectorAll(".tab_li"),
arrowIcons = document.querySelectorAll(".icono_opc i");

const btn_izq = document.querySelector('.icono_izq')
const btn = document.querySelector('.icono_der')
btn.addEventListener('click', () => 
{
    btn.classList.remove('animate')
    setTimeout(() => btn.classList.add('animate'), 100)
})
btn_izq.addEventListener('click', () => 
{
    btn_izq.classList.remove('animate')
    setTimeout(() => btn_izq.classList.add('animate'), 100)
})

window.addEventListener('resize', start_tabs);
let tabs_center = tabsBox.scrollWidth - tabsBox.clientWidth;
(tabs_center <= 0)? tabsBox.classList.add('justify-content-center') : null;
(tabs_center <= 0)?  arrowIcons[1].parentElement.classList.add('ocultar_boton_derecho') : null;

function start_tabs()
{
    tabs_center = tabsBox.scrollWidth - tabsBox.clientWidth;
    (tabs_center <= 0)? tabsBox.classList.add('justify-content-center') : tabsBox.classList.remove('justify-content-center');
    (tabs_center <= 0)?  arrowIcons[1].parentElement.classList.add('ocultar_boton_derecho') : arrowIcons[1].parentElement.classList.remove('ocultar_boton_derecho');
}
let isDragging = false;
const handleIcons = (scrollVal) => 
{
    let maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
    arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
    arrowIcons[1].parentElement.style.display = maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
}

arrowIcons.forEach(icon => {
    icon.addEventListener("click", () => 
    {
        // if clicked icon is left, reduce 350 from tabsBox scrollLeft else add
        let scrollWidth = tabsBox.scrollLeft += icon.id === "left" ? -340 : 340;
        handleIcons(scrollWidth);
    });
});

allTabs.forEach(tab => {
    tab.addEventListener("click", () => 
    {
        tabsBox.querySelector(".active").classList.remove("active");
        tab.classList.add("active");
    });
});

const dragging = (e) => {
    if(!isDragging) return;
    tabsBox.classList.add("dragging");
    tabsBox.scrollLeft -= e.movementX;
    handleIcons(tabsBox.scrollLeft)
}

const dragStop = () => {
    isDragging = false;
    tabsBox.classList.remove("dragging");
}

tabsBox.addEventListener("mousedown", () => isDragging = true);
tabsBox.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);