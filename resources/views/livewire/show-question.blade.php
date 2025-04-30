<div class="row">
    <!-- Navigation Panel -->
    <div class="col-md-3">
        <div class="list-group">
            @foreach($data as $index => $question)
                <button wire:click="goToQuestion({{ $index }})"
                        class="list-group-item list-group-item-action
                            {{ $counter === $index ? 'active' : '' }}
                            {{ isset($answers[$question->id]) ? 'list-group-item-success' : 'list-group-item-danger' }}">
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Question Display -->
    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $data[$counter]->title }}</h5>
                <div class="form-check" wire:model="answers.{{ $data[$counter]->id }}">
                    @foreach (preg_split('/(-)/', $data[$counter]->answers) as $index => $answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio{{ $counter }}{{ $index }}"
                            name="customRadio{{ $counter }}" class="custom-control-input"
                            wire:model="answers.{{ $data[$counter]->id }}" value="{{ $answer }}">
                        <label class="custom-control-label" for="customRadio{{ $counter }}{{ $index }}">
                            {{ $answer }}</label>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

        <!-- Navigation buttons -->
        <div class="d-flex justify-content-between">
            <button wire:click="previousQuestion" class="btn btn-secondary" {{ $counter == 0 ? 'disabled' : '' }}>السابق</button>
            <button wire:click="nextQuestion" class="btn btn-secondary" {{ $counter == $questioncount - 1 ? 'disabled' : '' }}>التالي</button>
        </div>

        <div class="mt-3">
            <button wire:click="finishQuiz" class="btn btn-success">إنهاء الاختبار</button>
        </div>

        <!-- Timer -->
        <div x-data="timerComponent({{ $timeLeft }})" x-init="start()" class="mt-4">
            <h4 class="text-danger">الوقت المتبقي: <span x-text="formattedTime"></span></h4>
        </div>
    </div>
</div>

<!-- Alpine.js Timer Script -->
<script>
    function timerComponent(seconds) {
        return {
            time: seconds,
            formattedTime: '',
            interval: null,

            start() {
                this.updateDisplay();
                this.interval = setInterval(() => {
                    if (this.time > 0) {
                        this.time--;
                        this.updateDisplay();
                        Livewire.emit('updateTimer');
                    } else {
                        clearInterval(this.interval);
                        Livewire.emit('autoSubmitQuiz');
                    }
                }, 1000);
            },

            updateDisplay() {
                const minutes = Math.floor(this.time / 60);
                const secs = this.time % 60;
                this.formattedTime = `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
            }
        }
    }
</script>
