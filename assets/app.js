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
import TomSelect from "tom-select";
import 'tom-select/dist/css/tom-select.bootstrap5.min.css'
import Filter from './modules/Filter'


new Filter(document.querySelector('.js-filter'))

async function jsonFetch(url) {
    const response = await fetch(url, {
        headers: {
            Accept: "application/json"
        }
    })
    if (response.status === 204) {
        return null
    }
    if (response.ok) {
        return await response.json()
    }
    throw response
}

/**
 * @param {HTMLSelectElement} select
 */
function bindSelect(select) {
    new TomSelect(select, {
        hideSelected: true,
        closeAfterSelect: true,
        valueField: select.dataset.value,
        labelField: select.dataset.label,
        searchField: select.dataset.label,
        plugins: {
            remove_button: {title: "Supprimer cet élément"}
        },
        load: async (query, callback) => {
            const url = `${select.dataset.remote}?q=${encodeURIComponent(query)}`
            callback(await jsonFetch(url))
        }
    })
}

Array.from(document.querySelectorAll('select[multiple]')).map(bindSelect)

let plus = $(".category")
plus.on("click", (e) => {
    let listSubcategory = $(".subcategory-" + e.target.id)
    listSubcategory.toggle()
})
$("#datatable").DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json'
    },
    pageLength: 50,
    autoWidth: false
})
$(function () {

    let subCategory = $(".subcategory")
    subCategory.on("click", (e) => {
        let listProduct = $(".cat" + e.target.id)
        let table = listProduct.children()
        listProduct.toggle()
        if (table.attr("id")) {
            table.removeAttr("id", "datatable")
        } else {
            table.attr("id", "datatable")
        }
    })

    let category = $(".category")
    category.on("click", (e) => {
        let listProduct = $(".cat" + e.target.id)
        let table = listProduct.children()
        listProduct.toggle()
        if (table.attr("id")) {
            table.removeAttr("id", "datatable")
        } else {
            table.attr("id", "datatable")
        }
    })
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

// function appear(element) {
//     return element.slideToggle()
// }
//
// const testimonials = $('#texts')
//     .children()
//     .filter('div.text');
//
// const showTestimonial = index => {
//     testimonials.hide();
//     $(testimonials[index]).fadeIn();
//
//     return index === testimonials.length
//         ? showTestimonial(0)
//         : setTimeout(() => {
//             showTestimonial(index + 1);
//         }, 5000);
// }
//
// showTestimonial(0); // id of the first element you want to show.

$(".btn-hidden").hover(() => {
    $(".menu-nav").toggleClass("visible")
})
$(".menu-nav").hover(() => {
    $(".menu-nav").toggleClass("visible")
})