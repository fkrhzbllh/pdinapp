<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i|Lato:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
    <!-- End Font -->
    <!-- Import Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!-- End Bootstrap CSS -->
    <!-- Import Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
    <!-- End Bootstrap Icon -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    </link>
    <link ref="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Import Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/styles/styles.css" />
    <title>Dashboard</title>
</head>

<body class="bg-white">

    <?= $this->include('layout/user/user-sidebar'); ?>

    <!-- Content -->
    <div id="content-dashboard" class="">
        <?= $this->include('layout/user/user-navbar'); ?>

        <div class="p-5 col-12 bg-white">
            <!-- Page content -->
            <?= $this->renderSection('content'); ?>
        </div>

    </div>

    <!-- Script -->
    <?= $this->renderSection('script'); ?>

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
            $('body').on('click', function() {
                dropdownProfile.classList.toggle('show');
            })
        })
    </script>

    <!-- Import Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>