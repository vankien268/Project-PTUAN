// Thông báo lỗi
function alertError(message = '', title = 'Oops...') {
    Swal.fire({
        icon: 'error',
        title: title,
        text: message
    })
}

function alertSuccess(message = '', title = '') {
    Swal.fire({
        icon: 'success',
        title: title,
        text: message
    })
}


// create slug
String.prototype.slug = function (character = '-') {
    return this.trim().toLowerCase()
        .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
        .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
        .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
        .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
        .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
        .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
        .replace(/đ/gi, 'd')
        .replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
        .replace(/ /gi, character)
        .replace(/\-\-\-\-\-/gi, character)
        .replace(/\-\-\-\-/gi, character)
        .replace(/\-\-\-/gi, character)
        .replace(/\-\-/gi, character)
}
$('[to-slug]').keyup(function (e) {
    e.preventDefault();
    let target = $(this).attr('to-slug');
    $(target).val($(this).val().slug())
})

$('input[type=file][preview-avatar]').change(function (e) {
    let target=$($(this).attr('data-target'));
    target.attr('src',(window.URL ? URL : webkitURL).createObjectURL($(this).prop('files')[0]));
})
