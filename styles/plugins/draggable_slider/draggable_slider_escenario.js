const tabsBox_esc = document.querySelector(".tabs-box_esc"),
allTabs_esc = tabsBox_esc.querySelectorAll(".tab_esc"),
arrowIcons_esc = document.querySelectorAll(".icono_esc i");

const btn_izq_esc = document.querySelector('.icono_izq_esc')
const btn_esc = document.querySelector('.icono_der_esc')
btn_esc.addEventListener('click', () => 
{
    btn_esc.classList.remove('animate')
    setTimeout(() => btn_esc.classList.add('animate'), 100)
})
btn_izq_esc.addEventListener('click', () => 
{
    btn_izq_esc.classList.remove('animate')
    setTimeout(() => btn_izq_esc.classList.add('animate'), 100)
})

window.addEventListener('resize', start_tabs_esc);
let tabs_center_esc = tabsBox_esc.scrollWidth - tabsBox_esc.clientWidth;
(tabs_center_esc <= 0)? tabsBox_esc.classList.add('justify-content-center') : null;
(tabs_center_esc <= 0)?  arrowIcons_esc[1].parentElement.classList.add('ocultar_boton_derecho') : null;

function start_tabs_esc()
{
    tabs_center_esc = tabsBox_esc.scrollWidth - tabsBox_esc.clientWidth;
    (tabs_center_esc <= 0)? tabsBox_esc.classList.add('justify-content-center') : tabsBox_esc.classList.remove('justify-content-center');
    (tabs_center_esc <= 0)?  arrowIcons_esc[1].parentElement.classList.add('ocultar_boton_derecho') : arrowIcons_esc[1].parentElement.classList.remove('ocultar_boton_derecho');
}
let isDragging_esc = false;
const handleIcons_esc = (scrollVal) => 
{
    let maxScrollableWidth_esc = tabsBox_esc.scrollWidth - tabsBox_esc.clientWidth;
    arrowIcons_esc[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
    arrowIcons_esc[1].parentElement.style.display = maxScrollableWidth_esc - scrollVal <= 1 ? "none" : "flex";
}

arrowIcons_esc.forEach(icon => {
    icon.addEventListener("click", () => 
    {
        // if clicked icon is left, reduce 350 from tabsBox scrollLeft else add
        let scrollWidth_esc = tabsBox_esc.scrollLeft += icon.id === "left_esc" ? -340 : 340;
        handleIcons_esc(scrollWidth_esc);
    });
});

allTabs_esc.forEach(tab => {
    tab.addEventListener("click", () => 
    {
        tabsBox_esc.querySelector(".active").classList.remove("active");
        tab.classList.add("active");
    });
});

const dragging_esc = (e) => {
    if(!isDragging_esc) return;
    tabsBox_esc.classList.add("dragging");
    tabsBox_esc.scrollLeft -= e.movementX;
    handleIcons(tabsBox_esc.scrollLeft)
}

const dragStop_esc = () => {
    isDragging_esc = false;
    tabsBox_esc.classList.remove("dragging");
}

tabsBox_esc.addEventListener("mousedown", () => isDragging_esc = true);
tabsBox_esc.addEventListener("mousemove", dragging_esc);
document.addEventListener("mouseup", dragStop_esc);