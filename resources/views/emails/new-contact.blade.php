<!DOCTYPE html>
<html>
<head>
	<title>Bạn có liên hệ mới</title>
</head>
<body>
   

<p>Họ tên: {{ $data['name'] }}</p>
<p>Email: {{ $data['email'] }}</p>
<p>Tiêu đề: {{ $data['subject'] }}</p>
<p>Nội dung: </p>
<p>{{ $data['message'] }}</p>  

</body>
</html>