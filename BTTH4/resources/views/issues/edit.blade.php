<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sửa Vấn Đề</title>
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
        <form action="{{ route('issues.update', $issue->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h2 class="text-center">Sửa Vấn Đề</h2>
            <div class="form-group">
                <label for="issue_id">Mã Vấn Đề:</label>
                <input type="text" id="issue_id" class="form-control" value="{{ $issue->id }}" disabled>
            </div>
            <div class="form-group">
                <label for="computer_id">Tên Máy Tính</label>
                <select id="computer_id" class="form-control" name="computer_id" required>
                    @foreach ($computers as $computer)
                        <option value="{{ $computer->id }}" {{ $computer->id === $issue->computer_id ? 'selected' : '' }}>
                            {{ $computer->computer_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="reported_by">Người Báo Cáo</label>
                <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{ $issue->reported_by }}" required>
            </div>
            <div class="form-group">
                <label for="reported_date">Thời Gian Báo Cáo</label>
                <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" value="{{ $issue->reported_date }}" required>
            </div>
            <div class="form-group">
                <label for="urgency">Mức Độ</label>
                <select id="urgency" class="form-control" name="urgency" required>
                    <option value="Low" {{ $issue->urgency === 'Low' ? 'selected' : '' }}>Thấp</option>
                    <option value="Medium" {{ $issue->urgency === 'Medium' ? 'selected' : '' }}>Trung Bình</option>
                    <option value="High" {{ $issue->urgency === 'High' ? 'selected' : '' }}>Cao</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $issue->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="status">Trạng Thái</label>
                <select id="status" class="form-control" name="status" required>
                    <option value="Open" {{ $issue->status === 'Open' ? 'selected' : '' }}>Mở</option>
                    <option value="In Progress" {{ $issue->status === 'In Progress' ? 'selected' : '' }}>Đang Xử Lý</option>
                    <option value="Resolved" {{ $issue->status === 'Resolved' ? 'selected' : '' }}>Đã Giải Quyết</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Hủy</button>
                <button type="submit" class="btn btn-success">Cập Nhật</button>
            </div>
        </form>
    </div>
</body>
</html>
