<h3>ADGROUP contact</h3>
<table style="font-size: 15px;">
    <tr>
        <td><label>- Họ tên:</label></td>
        <td> {{ !empty($name) ? $name : "" }}</td>
    </tr>
    <tr>
        <td><label>- Đơn vị công tác:</label></td>
        <td> {{ !empty($comany) ? $comany : "" }}</td>
    </tr>
    <tr>
        <td><label>- Số điện thoại:</label></td>
        <td> {{ !empty($phone) ? $phone : "" }}</td>
    </tr>
    <tr>
        <td><label>- Email:</label></td>
        <td> {{ !empty($email) ? $email : "" }}</td>
    </tr>
    <tr>
        <td><label>- Nội dung:</label></td>
        <td> {{ !empty($content) ? $content : "" }}</td>
    </tr>
</table>