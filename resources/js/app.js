import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Chart from 'chart.js/auto';
window.Chart = Chart;

// Sidebar Toggle
document.addEventListener('DOMContentLoaded', () => {

    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.sidebar-overlay');

    if(menuBtn && sidebar){

        menuBtn.addEventListener('click', () => {

            sidebar.classList.toggle('show');

            if(overlay){
                overlay.classList.toggle('show');
            }

        });

    }

    if(overlay){

        overlay.addEventListener('click', () => {

            sidebar.classList.remove('show');
            overlay.classList.remove('show');

        });

    }

    window.addEventListener('resize',()=>{

        if(window.innerWidth>991){

            sidebar.classList.remove('show');

            if(overlay){
                overlay.classList.remove('show');
            }

        }

    });

});