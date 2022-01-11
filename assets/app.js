/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
import "bootstrap"
import 'datatables.net'
import 'datatables.net-bs5'

require('jquery-ui/ui/widgets/droppable');
require('jquery-ui/ui/widgets/sortable');
require('jquery-ui/ui/widgets/selectable');
import $ from "jquery"
import "nouislider/dist/nouislider.css"

$("#datatable").DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json'
    },
    pageLength: 50,
    autoWidth: false
})
$(function () {
    $("#sortable").sortable({
        placeholder: "fantom",
        update: function (event, ui) {
            const list = $("tbody#sortable")
            let pos = 0;
            $(list.find("tr")).each(function () {
                pos++
                $(this).find("input.positionInput").val(pos)
                $(this).find(".positionBrut").html(pos)
            })
        }
    });
});
// tinymce.init({
//     selector: 'textarea',
//     plugins: 'image code',
//     toolbar: 'undo redo | link image | code',
//     image_title: true,
//     automatic_uploads: true,
//     file_picker_types: 'image',
//     file_picker_callback: function (cb, value, meta) {
//         var input = document.createElement('input');
//         input.setAttribute('type', 'file');
//         input.setAttribute('accept', 'image/*');
//         input.onchange = function () {
//             var file = this.files[0];
//             var reader = new FileReader();
//             reader.onload = function () {
//                 var id = 'blobid' + (new Date()).getTime();
//                 var blobCache = tinymce.activeEditor.editorUpload.blobCache;
//                 var base64 = reader.result.split(',')[1];
//                 var blobInfo = blobCache.create(id, file, base64);
//                 blobCache.add(blobInfo);
//                 cb(blobInfo.blobUri(), {title: file.name});
//             };
//             reader.readAsDataURL(file);
//         };
//         input.click();
//     }
// });

$(document).ready(() => {
    let nomination = $(".section-text")
    let price = $(".section-price")
    let createSection = $(".section-inge")
    let options = $(".section-options")
    let attachment = $(".section-download")
    let meta = $(".section-meta")
    let declination = $(".section-declination")
    let productSections = $(".product-section")
    let formatSections = $(".product-productFormat")
    let inputItem = $(".input-item")

    $(".item-text").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        nomination.show()
        e.target.classList.add('table-active')
    })
    $(".item-productFormat").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        formatSections.show()
        e.target.classList.add('table-active')
    })
    $(".item-price").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        price.show()
        e.target.classList.add('table-active')
    })
    $(".item-inge").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        createSection.show()
        e.target.classList.add('table-active')
    })
    $(".item-download").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        attachment.show()
        e.target.classList.add('table-active')
    })
    $(".item-options").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        options.show()
        e.target.classList.add('table-active')
    })

    $(".item-meta").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        meta.show()
        e.target.classList.add('table-active')
    })

    $(".item-declination").click((e) => {
        inputItem.removeClass("table-active")
        productSections.hide()
        declination.show()
        e.target.classList.add('table-active')
    })
})

$(".add-declination").click(() => {
    $('.formDeclination').toggle()
})

function appear(element) {
    return element.slideToggle()
}

const testimonials = $('#texts')
    .children()
    .filter('div.text');

const showTestimonial = index => {

    testimonials.hide();
    $(testimonials[index]).fadeIn();

    return index === testimonials.length
        ? showTestimonial(0)
        : setTimeout(() => {
            showTestimonial(index + 1);
        }, 5000);
}

showTestimonial(0); // id of the first element you want to show.

$(".btn-hidden").hover(() => {
    $(".menu-nav").toggleClass("visible")
})
$(".menu-nav").hover(() => {
    $(".menu-nav").toggleClass("visible")
})

let button = document.querySelector('.signup')

button.onclick = function () {
    document.getElementById('container').scrollTop += 20;
};

let subMenu = $(".sub-menu")
subMenu.on("click", () => {
    $('#texts').toggle()
})

var scrolled = 0;
$("a").on("click", function () {
    scrolled = scrolled - 300;
    $("a").stop().animate({
        scrollTop: scrolled
    });
});