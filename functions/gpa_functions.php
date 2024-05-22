<?php

function getAllStudentSubjects($id) {
    global $conn;
    $sql = "SELECT 
                h.MaHP,
                h.TenHP,
                h.SoDVHT,
                n.TenNganh,
                k.TenKhoa,
                h.HocKy,
                d.DiemHP
            FROM 
                hocphan h
            JOIN 
                diemhp d ON h.MaHP = d.MaHP
            JOIN 
                nganh n ON h.MaNganh = n.MaNganh
            JOIN 
                khoa k ON n.MaKhoa = k.MaKhoa
            WHERE 
                d.MaSV = '$id'
            ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->get_result();
}

?>
