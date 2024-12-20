<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thêm vấn đề</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-family: 'Varela Round', sans-serif;
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-default {
            border: 1px solid #cccccc;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf
            <h2 class="text-center">Thêm Vấn Đề</h2>
            <div class="form-group">
                <label for="computer_id">Tên Máy Tính</label>
                <select id="computer_id" class="form-control" name="computer_id" required>
                    <option value="" disabled selected>Chọn máy tính...</option>
                    @foreach ($computers as $computer)
                        <option value="{{ $computer->id }}">{{ $computer->computer_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="reported_by">Người Báo Cáo</label>
                <input type="text" class="form-control" id="reported_by" name="reported_by" placeholder="Nhập tên người báo cáo" required>
            </div>
            <div class="form-group">
                <label for="reported_date">Thời Gian Báo Cáo</label>
                <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" required>
            </div>
            <div class="form-group">
                <label for="urgency">Mức Độ</label>
                <select id="urgency" class="form-control" name="urgency" required>
                    <option value="Low">Thấp</option>
                    <option value="Medium">Trung Bình</option>
                    <option value="High">Cao</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả chi tiết" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Trạng Thái</label>
                <select id="status" class="form-control" name="status" required>
                    <option value="Open">Mở</option>
                    <option value="In Progress">Đang Xử Lý</option>
                    <option value="Resolved">Đã Giải Quyết</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Hủy</button>
                <button type="submit" class="btn btn-success">Thêm</button>
            </div>
        </form>
    </div>
</body>
</html>
