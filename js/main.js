// Toggle header menu
var hamburgerButton = document.querySelector('.header-hamburger');
var headerMenu = document.querySelector('.header-menu');

if (hamburgerButton) {
    hamburgerButton.addEventListener('click', toggleMenu);
}

function toggleMenu() {
    headerMenu.classList.toggle('active');
}

// Close location
var locationCloseButton = document.querySelector('.location-close');
var locationContainer = document.querySelector('.location');

if(locationCloseButton)
    locationCloseButton.addEventListener('click', closeLocation);

function closeLocation() {
    locationContainer.classList.remove('active');
}

// Select time in callback
var callbackBlock = document.querySelector('.callback');

var hours = document.querySelector('#callback-hours');
var minutes = document.querySelector('#callback-minutes');

var hoursIncrease = document.querySelector('#hours-increase');
var hoursDecrease = document.querySelector('#hours-decrease');

var minutesIncrease = document.querySelector('#minutes-increase');
var minutesDecrease = document.querySelector('#minutes-decrease');

if (callbackBlock) {
    var hoursCount = 0;
    var minutesCount = 0;

    hoursIncrease.addEventListener('click', plusHours);
    hoursDecrease.addEventListener('click', minusHours);

    minutesIncrease.addEventListener('click', plusMinutes);
    minutesDecrease.addEventListener('click', minusMinutes);
}

function plusHours() {
    if (parseInt(hours.value) < 23) {
        hoursCount++;
        hours.value = hoursCount;
    } else {
        hours.value = 0;
        hoursCount = 0;
    }
}

function minusHours() {
    if (parseInt(hours.value) > 1) {
        hoursCount--;
        hours.value = hoursCount;
    } else {
        hours.value = 0;
        hoursCount = 0;
    }
}

function plusMinutes() {
    if (parseInt(minutes.value) < 50) {
        minutesCount += 10;
        minutes.value = minutesCount;
    } else {
        minutes.value = 0;
        minutesCount = 0;
    }
}

function minusMinutes() {
    if (parseInt(minutes.value) > 1) {
        minutesCount = minutesCount - 10;
        minutes.value = minutesCount;
    } else {
        minutes.value = 0;
        minutesCount = 0;
    }
}

// Show video
var videoPlayButtons = document.querySelectorAll('.video-play');
var videoTracks = document.querySelectorAll('.video-track');

videoPlayButtons.forEach(function(button) {
    button.addEventListener('click', showVideo);
});

videoTracks.forEach(function(track) {
    track.addEventListener('pause', pauseVideo);
})

function showVideo() {
    this.parentElement.parentElement.style.display = 'none';
    this.parentElement.parentElement.nextElementSibling.play();
}

function pauseVideo() {
    this.previousElementSibling.style.display = 'flex';
}

// Faq quistions toggle
var helpQuestions = document.querySelectorAll('.help-question');

helpQuestions.forEach(function(question) {
    question.addEventListener('click', toggleQuestion);
});

function toggleQuestion(e) {
    e.preventDefault();
    this.classList.toggle('active');
    this.nextElementSibling.classList.toggle('active');
}

// Extend about team information
var extendTeamButtons = document.querySelectorAll('.about-team-extend');

extendTeamButtons.forEach(function(button) {
    button.addEventListener('click', extendTeamInfo);
});

function extendTeamInfo() {
    this.classList.toggle('active');
    this.previousElementSibling.classList.toggle('active');
}

// Extend about news information
var extendNewsButtons = document.querySelectorAll('.about-news-extend');

extendNewsButtons.forEach(function(button) {
    button.addEventListener('click', extendNewsInfo);
});

function extendNewsInfo(e) {
    e.preventDefault();
    this.classList.toggle('active');
    this.previousElementSibling.classList.toggle('active');
}

// Show menus in personal navigation
var personalDropMenus = document.querySelectorAll('.personal-dropdown-menu');

var notificationButton = document.querySelector('.personal-navigation-notification');
var notificationMenu = document.querySelector('.notification-dropdown');

var avatarButton = document.querySelector('.personal-navigation-avatar');
var avatarMenu = document.querySelector('.avatar-dropdown');

if (notificationButton) {
    notificationButton.addEventListener('click', toggleNotificationMenu);
}

if (avatarButton) {
    avatarButton.addEventListener('click', toggleAvatarMenu);
}

function toggleNotificationMenu(e) {
    e.preventDefault();

    if (notificationMenu.classList.contains('active')) {
        notificationMenu.classList.remove('active');   
    } else {
        personalDropMenus.forEach(function(menu) {
            menu.classList.remove('active');
        });
        notificationMenu.classList.add('active');
    }
}

function toggleAvatarMenu(e) {
    e.preventDefault();

    if (avatarMenu.classList.contains('active')) {
        avatarMenu.classList.remove('active');   
    } else {
        personalDropMenus.forEach(function(menu) {
            menu.classList.remove('active');
        });
        avatarMenu.classList.add('active');
    }
}

// Show side menu links
var sideMenuButton = document.querySelector('.side-menu-extend');
var sideMenuLinks = document.querySelector('.side-menu-links');

if (sideMenuButton) {
    sideMenuButton.addEventListener('click', extendSideMenu);
}

function extendSideMenu() {
    this.classList.toggle('active');
    sideMenuLinks.classList.toggle('active');
}

// Set reminder
var reminderButttons = document.querySelectorAll('.set-reminder-button');
var reminderForms = document.querySelectorAll('.reminder-form');

if (reminderButttons) {
    reminderButttons.forEach(function(button) {
        button.addEventListener('click', setReminder);
    });
}

function setReminder() {

    if (this.classList.contains('active')) {
        this.classList.remove('active');
        this.nextElementSibling.classList.remove('active');
    } else {
        reminderForms.forEach(function(form) {
            if (form.classList.contains('active')) {
                form.classList.remove('active');
            }
        });
    
        reminderButttons.forEach(function(button) {
            if (button.classList.contains('active')) {
                button.classList.remove('active');
            }
        });

        this.classList.add('active');
        this.nextElementSibling.classList.add('active');
    }
}

// Mark colors
var markButtons = document.querySelectorAll('.mark-button');
var markColors = document.querySelectorAll('.mark-set-color');

if (markButtons) {
    markButtons.forEach(function(button) {
        button.addEventListener('click', openColorSet);
    });
}

function openColorSet() {
    this.nextElementSibling.classList.toggle('active');
}

if (markColors) {
    markColors.forEach(function(color) {
        color.addEventListener('click', chooseColor);
    });
}

function chooseColor() {
    var targetClass = this.getAttribute('data-color');
    var finalColor = this.parentElement.previousElementSibling.querySelector('.mark-color');
    var colorSet = this.parentElement;
    finalColor.className = '';
    finalColor.classList.add('mark-color', targetClass);
    colorSet.classList.remove('active');
}

// Tabs
var tabLinks = document.querySelectorAll('.tab-link');
var tabContents = document.querySelectorAll('.tab-content');

if (tabLinks) {
    tabLinks.forEach(function(link) {
        link.addEventListener('click', switchTabs);
    });
}

function switchTabs(e) {
    var targetHref = this.getAttribute('href');
    var activeTabContent = document.querySelector(targetHref);

    e.preventDefault();
    tabLinks.forEach(function(link) {
        link.classList.remove('active');
    });
    tabContents.forEach(function(content) {
        content.classList.remove('active');
    });
    this.classList.add('active');
    activeTabContent.classList.add('active');
}

// Extend my orders table
var orderInfoRows = document.querySelectorAll('.order-info');
var orderCloseButtons = document.querySelectorAll('.order-detailed-close');

if (orderInfoRows) {
    orderInfoRows.forEach(function(row) {
        row.addEventListener('click', extendOrderInfo);
    })
}

if (orderCloseButtons) {
    orderCloseButtons.forEach(function(button) {
        button.addEventListener('click', closeOrderInfo);
    });
}

function extendOrderInfo() {
    this.nextElementSibling.classList.add('active');
    init();
}

function closeOrderInfo() {
    this.parentElement.parentElement.parentElement.classList.remove('active');
}

// Show my orders answers
var executersAnswerButtons = document.querySelectorAll('.executer-answers-show');

if (executersAnswerButtons) {
    executersAnswerButtons.forEach(function(button) {
        button.addEventListener('click', showExecutersAnswers);
    });
}

function showExecutersAnswers() {
    this.classList.toggle('active');
    this.parentElement.nextElementSibling.classList.toggle('active');
}

// Extend executers info in orders
var executerInfoRows = document.querySelectorAll('.order-executer');

if (executerInfoRows) {
    executerInfoRows.forEach(function(row) {
        row.addEventListener('click', extendExecutorInfo);
    });
}

function extendExecutorInfo() {
    this.nextElementSibling.classList.toggle('active');
}


$(document).ready(function() {
    // Magnific popups
    $('[href="#login"], [href="#registration"], [href="#wallet"],[href="#send-mail"]').magnificPopup({
        type: 'inline'
    });
});