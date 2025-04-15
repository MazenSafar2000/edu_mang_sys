<div>
    <div class="card card-statistics mb-30">
        <div class="card-body">
            @if($data->isEmpty())
                <h4 class="text-danger"> لا توجد أسئلة متاحة لهذا الاختبار حتى الآن.</h4>
                <a href="{{ url('student_exams') }}" class="btn btn-primary">العودة إلى قائمة الاختبارات</a>
            @else
                <!-- Timer Display -->
                <h4 class="text-danger">الوقت المتبقي: <span id="timer">{{ gmdate('i:s', $timeLeft) }}</span></h4>

                <h5 class="card-title"> {{$data[$counter]->title}}</h5>

                @foreach(preg_split('/(-)/', $data[$counter]->answers) as $index => $answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio{{$counter}}{{$index}}" name="customRadio{{$counter}}"
                               class="custom-control-input"
                               wire:model="answers.{{$data[$counter]->id}}" value="{{$answer}}">
                        <label class="custom-control-label" for="customRadio{{$counter}}{{$index}}"> {{$answer}}</label>
                    </div>
                @endforeach

                <br>

                <!-- Navigation Buttons -->
                <button class="btn btn-secondary" wire:click="previousQuestion" @if($counter == 0) disabled @endif>Previous</button>
                <button class="btn btn-primary" wire:click="nextQuestion">Next</button>

                <!-- Finish Attempt Button -->
                <button class="btn btn-success" wire:click="finishQuiz">Finish Attempt</button>
            @endif
        </div>
    </div>
</div>
