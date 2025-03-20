  @extends('layouts.master')

  @section('content')
      <div class="container bg-white p-4 mt-8 rounded"
          style="max-width: 1000px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
          <h2>Jadwal Maintenance</h2>
          <form action="{{ url('/maintenance/add-note') }}" method="POST">
              @csrf
              <div class="mb-3">
                  <label for="date" class="form-label">Tanggal:</label>
                  <input type="date" name="date" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="note" class="form-label">Catatan:</label>
                  <input type="text" name="note" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-success">Tambahkan Catatan</button>
          </form>

          <div id='calendar'></div>

          <h3 class="mt-4">Catatan Maintenance</h3>
          <ul class="list-group">
              @foreach ($notes as $note)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><strong>{{ $note->date }}</strong>: {{ $note->note }}</span>
                  </li>
              @endforeach
          </ul>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              var calendarEl = document.getElementById('calendar');
              var calendar = new FullCalendar.Calendar(calendarEl, {
                  initialView: 'dayGridMonth',
                  events: [
                      @foreach ($notes as $note)
                          {
                              title: '{{ $note->note }}',
                              start: '{{ $note->date }}',
                          },
                      @endforeach
                  ]
              });
              calendar.render();
          });
      </script>
  @endsection
