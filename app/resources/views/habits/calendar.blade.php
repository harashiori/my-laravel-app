@extends('layouts.app')

@section('content')
  <div class="container py-4">
    <h2 class="mb-4">タイムテーブル</h2>
    <div class="alert alert-info">※ ドラッグして時間範囲を選択すると習慣を追加できます。</div>

    <div class="calendar-wrapper">
      <!-- ヘッダー -->
      <div class="calendar-header">
        <div class="time-col"></div>
        @foreach (['月', '火', '水', '木', '金', '土', '日'] as $day)
          <div class="day-col">{{ $day }}</div>
        @endforeach
      </div>

      <!-- 本体 -->
      <div class="calendar-body">
        @for ($h = 0; $h < 24; $h++)
          @foreach ([0, 30] as $m)
            <div class="time-row">
              <div class="time-col">{{ sprintf('%02d:%02d', $h, $m) }}</div>
              @for ($d = 1; $d <= 7; $d++)
                <div class="day-cell" 
                  data-day="{{ $d }}" 
                  data-hour="{{ $h + $m/60 }}">
                </div>
              @endfor
            </div>
          @endforeach
        @endfor
      </div>
    </div>

    <div class="text-end mt-3">
      <button class="btn btn-success">保存</button>
    </div>
  </div>

  <!-- モーダル -->
  <div class="modal fade" id="habitModal" tabindex="-1">
    <div class="modal-dialog">
      <form id="habitForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">習慣を追加</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">習慣</label>
            <select name="habit_name" class="form-select" required>
              <option value="">選択してください</option>
              @foreach ($habits as $habit)
                <option value="{{ $habit->name }}">{{ $habit->name }}</option>
              @endforeach
            </select>
          </div>
          <input type="hidden" name="start_day">
          <input type="hidden" name="start_hour">
          <input type="hidden" name="end_hour">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">追加</button>
        </div>
      </form>
    </div>
  </div>

  <style>
  .calendar-wrapper {
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
  }

  .calendar-header {
    display: grid;
    grid-template-columns: 80px repeat(7, 1fr);
    background: #f8f9fa;
    border-bottom: 1px solid #ddd;
  }

  .time-col {
    padding: 4px;
    font-weight: bold;
    text-align: center;
    border-right: 1px solid #ddd;
    font-size: 0.85rem;
  }

  .day-col {
    padding: 8px;
    text-align: center;
    font-weight: bold;
    border-right: 1px solid #ddd;
  }

  .calendar-body {
    /* スクロール無し */
  }

  .time-row {
    display: grid;
    grid-template-columns: 80px repeat(7, 1fr);
    min-height: 25px; /* 30分単位なので高さを小さめに */
    border-bottom: 1px solid #eee;
  }

  .day-cell {
    border-right: 1px solid #eee;
    position: relative;
    background: #fff;
  }

  .day-cell.selected {
    background: rgba(0, 123, 255, 0.2);
  }

  .event-block {
    position: absolute;
    top: 0;
    left: 5%;
    width: 90%;
    background: rgba(0, 123, 255, 0.8);
    color: white;
    border-radius: 4px;
    padding: 2px 4px;
    font-size: 0.75rem;
  }
  </style>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    let isDragging = false;
    let startCell = null;
    let endCell = null;

    const cells = document.querySelectorAll('.day-cell');

    cells.forEach(cell => {
        cell.addEventListener('mousedown', e => {
            isDragging = true;
            startCell = cell;
            cell.classList.add('selected');
        });

        cell.addEventListener('mouseenter', e => {
            if (isDragging && startCell) {
                clearSelection();
                endCell = cell;
                highlightRange(startCell, endCell);
            }
        });

        cell.addEventListener('mouseup', e => {
            if (isDragging) {
                isDragging = false;
                endCell = cell;
                openModal(startCell, endCell);
            }
        });
    });

  document.addEventListener('mouseup', () => {
    isDragging = false;
  });

  function highlightRange(start, end) {
    const startDay = parseInt(start.dataset.day);
    const startHour = parseFloat(start.dataset.hour);
    const endDay = parseInt(end.dataset.day);
    const endHour = parseFloat(end.dataset.hour);

    if (startDay !== endDay) return;

    const minHour = Math.min(startHour, endHour);
    const maxHour = Math.max(startHour, endHour);

    cells.forEach(c => {
      if (parseInt(c.dataset.day) === startDay &&
        parseFloat(c.dataset.hour) >= minHour &&
        parseFloat(c.dataset.hour) <= maxHour) {
        c.classList.add('selected');
        }
      });
    }

    function clearSelection() {
      cells.forEach(c => c.classList.remove('selected'));
    }

    function openModal(start, end) {
      const startDay = parseInt(start.dataset.day);
      const startHour = parseFloat(start.dataset.hour);
      const endHour = parseFloat(end.dataset.hour);

      document.querySelector('#habitForm input[name="start_day"]').value = startDay;
      document.querySelector('#habitForm input[name="start_hour"]').value = Math.min(startHour, endHour);
      document.querySelector('#habitForm input[name="end_hour"]').value = Math.max(startHour, endHour) + 0.5;

      const modal = new bootstrap.Modal(document.getElementById('habitModal'));
      modal.show();
    }

    document.getElementById('habitForm').addEventListener('submit', e => {
      e.preventDefault();

      const name = e.target.habit_name.value;
      const day = parseInt(e.target.start_day.value);
      const startHour = parseFloat(e.target.start_hour.value);
      const endHour = parseFloat(e.target.end_hour.value);

      const firstCell = [...cells].find(c => 
        parseInt(c.dataset.day) === day &&
        parseFloat(c.dataset.hour) === startHour
        );

        if (firstCell) {
          const block = document.createElement('div');
          block.className = 'event-block';
          block.style.height = `${((endHour - startHour) * 25) - 2}px`; // 30分単位
          block.textContent = name;
          firstCell.appendChild(block);
        }

        clearSelection();
        bootstrap.Modal.getInstance(document.getElementById('habitModal')).hide();
        e.target.reset();
    });
  });
  </script>
@endsection