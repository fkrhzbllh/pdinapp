</div>
<!-- Import Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

<!-- tinymce -->
<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js">
</script>

<script>
    tinymce.init({
        selector: '#konten',
        plugins: [
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
            'wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
    });
</script>

<script>
    // SIDEBAR DROPDOWN
    const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
    const sidebar = document.getElementById('sidebar');

    allDropdown.forEach(item => {
        const a = item.parentElement.querySelector('a:first-child');
        a.addEventListener('click', function(e) {
            e.preventDefault();

            if (!this.classList.contains('active')) {
                allDropdown.forEach(i => {
                    const aLink = i.parentElement.querySelector('a:first-child');

                    aLink.classList.remove('active');
                    i.classList.remove('show');
                })
            }

            this.classList.toggle('active');
            item.classList.toggle('show');
        })
    })

    // SIDEBAR COLLAPSE
    const toggleSidebar = document.querySelector('#nav-dashboard .toggle-sidebar');
    const allSideDivider = document.querySelectorAll('#sidebar .divider');

    if (sidebar.classList.contains('hide')) {
        allSideDivider.forEach(item => {
            item.textContent = '-'
        })
        allDropdown.forEach(item => {
            const a = item.parentElement.querySelector('a:first-child');
            a.classList.remove('active');
            item.classList.remove('show');
        })


    } else {
        allSideDivider.forEach(item => {
            item.textContent = item.dataset.text;
        })
    }

    toggleSidebar.addEventListener('click', function() {
        sidebar.classList.toggle('hide');

        if (sidebar.classList.contains('hide')) {
            allSideDivider.forEach(item => {
                item.textContent = '-'
            })

            allDropdown.forEach(item => {
                const a = item.parentElement.querySelector('a:first-child');
                a.classList.remove('active');
                item.classList.remove('show');
            })
        } else {
            allSideDivider.forEach(item => {
                item.textContent = item.dataset.text;
            })
        }
    })

    sidebar.addEventListener('mouseleave', function() {
        if (this.classList.contains('hide')) {
            allDropdown.forEach(item => {
                const a = item.parentElement.querySelector('a:first-child');
                a.classList.remove('active');
                item.classList.remove('show');
            })
            allSideDivider.forEach(item => {
                item.textContent = '-'
            })
        }
    })

    sidebar.addEventListener('mouseenter', function() {
        if (this.classList.contains('hide')) {
            allDropdown.forEach(item => {
                const a = item.parentElement.querySelector('a:first-child');
                a.classList.remove('active');
                item.classList.remove('show');
            })
            allSideDivider.forEach(item => {
                item.textContent = item.dataset.text;
            })
        }
    })


    // PROFILE DROPDOWN
    const profile = document.querySelector('#nav-dashboard .profile');
    const imgProfile = profile.querySelector('img');
    const dropdownProfile = profile.querySelector('.profile-link');

    imgProfile.addEventListener('click', function() {
        dropdownProfile.classList.toggle('show');
    })
</script>

<!-- calendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/locales-all.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js"></script>

</body>

</html>