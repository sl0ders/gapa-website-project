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
import noUiSlider from "nouislider";
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
    let productItems = $(".product-item")
    let productSections = $(".product-section")

    $(".item-text").click(() => {
        productItems.removeClass("table-active")
        productSections.hide()
        nomination.show()
        $(".product-text").addClass('table-active')
    })
    $(".item-price").click(() => {
        productItems.removeClass("table-active")
        productSections.hide()
        price.show()
        $(".product-price").addClass('table-active')
    })
    $(".item-inge").click(() => {
        productItems.removeClass("table-active")
        productSections.hide()
        createSection.show()
        $(".product-inge").addClass('table-active')
    })
    $(".item-download").click(() => {
        productItems.removeClass("table-active")
        productSections.hide()
        attachment.show()
        $(".product-download").addClass('table-active')
    })
    $(".item-options").click(() => {
        productItems.removeClass("table-active")
        productSections.hide()
        options.show()
        $(".product-options").addClass('table-active')
    })

    $(".item-meta").click(() => {
        productItems.removeClass("table-active")
        productSections.hide()
        meta.show()
        $(".product-meta").addClass('table-active')
    })

    $(".item-declination").click(() => {
        productItems.removeClass("table-active")
        productSections.hide()
        declination.show()
        $(".product-meta").addClass('table-active')
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

const slider = document.getElementById('priceslider');


if (slider) {
    const min = document.getElementById("min")
    const max = document.getElementById("max")
    const range = noUiSlider.create(slider, {
        start: [min.value || 0, max.value || 10000],
        connect: true,
        step: 10,
        range: {
            'min': parseInt(slider.dataset.min, 10),
            'max':  parseInt(slider.dataset.max, 10)
        }
    });
    range.on("slide", function (values, handle) {
        if (handle === 0) {
            min.value = Math.round(values[0])
        }
        if (handle === 1) {
            max.value = Math.round(values[1])
        }
        console.log(values, handle)
    })
}
