
function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}