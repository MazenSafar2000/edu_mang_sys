// header starts
document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("menu-btn");
    const navbar = document.querySelector(".navbar");

    menuBtn.addEventListener("click", function () {
        navbar.classList.toggle("active"); // إظهار/إخفاء القائمة
    });
});

/// header ends


$(document).ready(function () {
    $('#calendar').fullCalendar({
        locale: 'ar',  // تغيير اللغة إلى العربية
        defaultView: 'month'
    });
});



let body = document.body;
let profile = document.querySelector('.header .flex .profile');
document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
    searchForm.classList.remove('active');

}

let searchForm = document.querySelector('.header .flex .search-form');
document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    profile.classList.remove('active');

}

let sideBar = document.querySelector('.side-bar');
document.querySelector('#menu-btn').onclick = () => {
    sideBar.classList.toggle('active');
    body.classList.toggle('active');

}

document.querySelector('.side-bar .close-btn').onclick = () => {
    sideBar.classList.toggle('active');
    body.classList.toggle('active');

}


let toggleBtn = document.querySelector('#toggle-btn');
let darkMode = localStorage.getItem('dark-mode');
let logoImg = document.querySelector(".logo img"); // تعريف الشعار


const enabelDarkMode = () => {
    toggleBtn.classList.replace('fa-sun', 'fa-moon');
    body.classList.add('dark');
    logoImg.src = "images/logo-dark.png"; // استبدال الشعار في الوضع الداكن
    localStorage.setItem('dark-mode', 'enabled');


}


const disableDarkMode = () => {
    toggleBtn.classList.replace('fa-moon', 'fa-sun');
    body.classList.remove('dark');
    logoImg.src = "images/spark.png"; // استبدال الشعار في الوضع الداكن
    localStorage.setItem('dark-mode', 'disabled');


}

if (darkMode === 'enabled') {
    enabelDarkMode();
}

toggleBtn.onclick = (e) => {
    let darkMode = localStorage.getItem('dark-mode');
    if (darkMode === 'disabled') {
        enabelDarkMode();
    } else {
        disableDarkMode();
    }
}

function showForm(userType, element) {
    // Step 1: Hide all forms
    document.querySelectorAll('.form').forEach(form => {
        form.style.opacity = '0';
        form.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            form.style.display = 'none';
        }, 300);
    });

    // Step 2: Show the selected form
    setTimeout(() => {
        let activeForm = document.getElementById(userType + '-form');
        if (activeForm) {
            activeForm.style.display = 'block';
            setTimeout(() => {
                activeForm.style.opacity = '1';
                activeForm.style.transform = 'translateY(0)';
            }, 50);
        }
    }, 300);

    // Step 3: Update active icon
    document.querySelectorAll('.icon').forEach(icon => {
        icon.classList.remove('active-icon');
    });

    element.classList.add('active-icon');

    // Step 4: Change icon images dynamically
    document.querySelectorAll('.icon').forEach(icon => {
        let img = icon.querySelector('img');
        if (img) {
            if (icon === element) {
                if (userType === 'student') img.src = "/assets/images/std-on.png";
                else if (userType === 'parent') img.src = "/assets/images/par-on.png";
                else if (userType === 'teacher') img.src = "/assets/images/teacher.png";
                else if (userType === 'admin') img.src = "/assets/images/manager.png";
            } else {
                if (img.alt.toLowerCase().includes('student')) img.src = "/assets/images/std-off.png";
                else if (img.alt.toLowerCase().includes('parent')) img.src = "/assets/images/par-off.png";
                else if (img.alt.toLowerCase().includes('teacher')) img.src = "/assets/images/teacher-off.png";
                else if (img.alt.toLowerCase().includes('admin') || img.alt.toLowerCase().includes('manager')) img.src = "/assets/images/manager-off.png";
            }
        }
    });
}

