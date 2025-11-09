   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
       document.getElementById('addPosadaButton').addEventListener('click', function() {
           let membershipType = '<?php echo $membership_type; ?>';
           let innCount = <?php echo $inn_count; ?>;

           if (membershipType === 'basic' && innCount > 0) {
               Swal.fire({
                   title: 'Límite alcanzado',
                   text: 'Ya has alcanzado el límite de posadas.',
                   icon: 'warning',
                   confirmButtonText: 'Actualizar Membresía',
                   onClose: () => {
                       window.location.href = 'Memberships.php';
                   }
               });
           } else if (membershipType === 'silver' && innCount >= 3) {
               Swal.fire({
                   title: 'Límite alcanzado',
                   text: 'Ya has alcanzado el límite de 3 posadas.',
                   icon: 'warning',
                   confirmButtonText: 'Actualizar Membresía',
                   onClose: () => {
                       window.location.href = '../Memberships.php';
                   }
               });
           } else {
               $('#posadaModal').modal('show');
           }
       });
   </script>