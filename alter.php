<?php
DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('superadmin', 'admin', 'dokter', 'pasien', 'apoteker', 'kasir') DEFAULT 'pasien'");
echo "Success Users Alter";
