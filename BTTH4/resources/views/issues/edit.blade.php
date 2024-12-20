<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sửa vấn đề</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <form action="{{route('issues.update', $issue->id)}}" method="POST">
                @csrf
                @method('PUT')
                <h2 class="modal-title text-center mt-2">Sửa vấn đề</h2>
                <div class="form-group">
                    <label>Mã vấn đề: {{$issue->id}}</label>
                </div>
                <div class="form-group">
                    <label>Tên máy tính</label>
                    <select id="computer_name" class="form-control" name="computer_name" required>
                        @foreach ($computers as $computer)
                        <option value="{{$computer->computer_name}}" 
                                data-model="{{$computer->model}}" 
                                {{ $computer->computer_name === $issue->computer->computer_name ? 'selected' : '' }}>
                            {{$computer->computer_name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Người báo cáo</label>
                    <input class="form-control" name="reported_by" value="{{$issue->reported_by}}" required></input>
                </div>
                <div class="form-group">
                    <label>Thời gian báo cáo</label>
                    <input type="datetime-local" class="form-control" name="reported_date" value="{{$issue->reported_date}}" required>
                </div>	
                <div class="form-group">
                    <label for="priority">Mức độ</label>
                    <select id="priority" class="form-control" name="urgency" required>
                        <option value="Low" {{ $issue->urgency === 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $issue->urgency === 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $issue->urgency === 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priority">Trạng thái</label>
                    <select id="priority" class="form-control" name="status" required>
                        <option value="Open" {{ $issue->status === 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In progress" {{ $issue->status === 'In progress' ? 'selected' : '' }}>In progress</option>
                        <option value="Resolved" {{ $issue->status === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>
					
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                <input type="submit" class="btn btn-success" value="Sửa">
            </form>
        </div>
    </body>

</html>