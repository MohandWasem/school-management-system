<div>
    <div>
        <div class="card card-statistics mb-30">
            <div class="card-body">
                <h5 class="card-title">{{$data[$counter]->title}}</h5>
                @foreach (preg_split('/(-)/' , $data[$counter]->answers) as $index=>$answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="customRadio" id="customRadio{{$index}}" inh>
                        <label class="custom-control-label" wire:click="nextQuestion('{{$data[$counter]->id}}','{{$data[$counter]->score}}', '{{$answer}}','{{$data[$counter]->right_answer}}')" for="customRadio{{$index}}">{{$answer}}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


