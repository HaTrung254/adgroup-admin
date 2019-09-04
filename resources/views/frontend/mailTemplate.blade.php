<h3>ADGROUP contact</h3>
<table style="font-size: 15px;">
    <tr>
        <td><label>- Họ tên:</label></td>
        <td> {{ !empty($hoten) ? $hoten : "" }}</td>
    </tr>
    @if(!empty($sanpham))
    <tr>
        <td><label>- Sản phẩm:</label></td>
        <td> {{ $sanpham }}</td>
    </tr>
    @endif
    <tr>
        <td><label>- Đơn vị công tác:</label></td>
        <td> {{ !empty($donvi) ? $donvi : "" }}</td>
    </tr>
    <tr>
        <td><label>- Số điện thoại:</label></td>
        <td> {{ !empty($sdt) ? $sdt : "" }}</td>
    </tr>
    <tr>
        <td><label>- Email:</label></td>
        <td> {{ !empty($email) ? $email : "" }}</td>
    </tr>
    <tr>
        <td><label>- Nội dung:</label></td>
        <td> {{ !empty($noidung) ? $noidung : "" }}</td>
    </tr>
</table>