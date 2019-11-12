<style>
    .quiz-question-pills li {
        background-color: black;
        color: white;
        margin: 10px;
        padding: 5px 15px 5px 35px;
        border-radius: 20px;
    }
    .quiz-question-pills li i {
        margin-left: 40px;
    }

    .quiz-question-pills li a {
        color: white;
    }
    .container-quiz-question-pills ul {
        margin-left: 35%;
    }
</style>



<template>


    <div>


        <div class="container quiz-steps" v-if="index === currentIndex && timer>0">
            <div>
                <span class="badge badge-danger">{{ minutes }}</span>
                <span class="badge badge-danger">{{ seconds }}</span>
            </div>
            <div class="progress">
                <div class="progress-bar bg-danger" role="progressbar" :style="{width: returnTimerWidth()}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <br>
            <!--                <div class="container-quiz-question-pills">-->
            <!--                    <ul class="nav nav-pills quiz-question-pills">-->
            <!--                        <li><a href="#"> {{ wrong }}</a><i class="icon-remove"></i></li>-->
            <!--                        <li><a href="#"> {{ right }} </a><i class="icon-ok"></i></li>-->
            <!--                    </ul>-->
            <!--                </div>-->
            <div class="question-content">
                <p>{{ questions[index].question }}</p>
                <!-- Material unchecked -->
                <div class="form-check">
                    <input type="radio" v-model="picked" checked="checked" class="form-check-input" value="1" id="radio_1" name="materialExampleRadios">
                    <label class="form-check-label" for="radio_1">{{ questions[index].option1 }} </label>
                </div>

                <!-- Material checked -->
                <div class="form-check">
                    <input type="radio" v-model="picked" checked="questions[index]['selectedIndex'][1]" class="form-check-input" value="2" id="materialChecked" name="materialExampleRadios">
                    <label class="form-check-label" for="materialChecked">{{ questions[index].option2 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" v-model="picked" checked="questions[index]['selectedIndex'][2]" class="form-check-input" value="3" id="materialChecked" name="materialExampleRadios">
                    <label class="form-check-label" for="materialChecked">{{ questions[index].option3 }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" v-model="picked" checked="questions[index]['selectedIndex'][3]" class="form-check-input" value="4" id="materialChecked" name="materialExampleRadios">
                    <label class="form-check-label" for="materialChecked">{{ questions[index].option4 }}</label>
                </div>

            </div>
            <br><br><br><br>
            <div>
                <button type="button" class="btn btn-outline-danger float-left btn-next" @click="previousQuestion()">Previous</button>
                <button type="button" class="btn btn-outline-danger float-right btn-next" @click="nextQuestion(questions[index].isCorrect)">Next</button>
            </div>
            <br>
            <div class="progress" style="margin-top:2rem;">
                <div class="progress-bar bg-danger" role="progressbar" :style="{width: returnWidth(index)}" aria-valuenow="100" aria-valuemin=0 aria-valuemax="100"></div>

            </div>
            <div class="text-center" style="margin-top: 2rem;">
                <button type="button" class="btn btn-outline-danger btn-next" @click="storeMarks()">Submit</button>
            </div>
        </div>






        <div class="container thankyou-quiz-page" v-if="currentIndex === questions.length || timer==0">
            <div class="text-center">
                <p>Thnakyou for taking the Quiz!</p>
                <br>
                <div class="thankyou-msg">
                    <p>You have answered <span>{{ right }}</span> correct answers out of <span>{{ questions.length }}</span>. Your total time was <span>{{ minutesTaken }}:{{ secondsTaken }}</span>. The answers were sent to the administrator and he will contact you shortly.</p>
                    <p>Your total marks are: {{calculateScore()}}</p>
                </div>

            </div>

        </div>
    </div>

</template>


<script>

    export default {
        name : 'TEST',
        props : [
            'quizid1'

        ],
        data(){
            // debugger
            return{
                currentIndex:0,
                index: 0,
                picked:'',
                right:0,
                wrong:0,
                questions:[],
                timer:0,
                total:0,
                minutes:0,
                seconds:0,
                minutesTaken:0,
                secondsTaken:0,
                remainingTime:0,
                done:false,
                interval: '',
                negative: 0,
                totalMarks: 0,
                quizId: 0
            }
        },
        methods:{
            nextQuestion:function(e){
                if(this.picked){

                    if(e==this.picked){
                        this.questions[this.index]['correctMarks']=1;

                        this.right++;
                    }
                    else{
                        this.wrong++;
                    }

                    this.questions[this.index]['selectedIndex'] = this.picked;

                }

                this.currentIndex++;
                this.index++;

                if(this.currentIndex == this.questions.length){
                    this.timer = 0;
                    this.storeMarks();
                }
                this.picked = '';


            },
            previousQuestion(){
                this.currentIndex--;
                this.index = this.index-1;
                if(this.questions[this.index]['correctMarks']===1){
                    this.right--;
                    this.questions[this.index]['correctMarks']=0;
                }

                this.picked= this.questions[this.index]['selectedIndex'];


            },
            returnWidth(e){
                if( e==0 ){
                    return 0+'%';
                }
                else {
                    return e / this.questions.length * 100+'%';

                }




            },
            returnTimerWidth(){
                if( this.remainingTime == 0 )
                {
                    return 0+'%';
                }
                else{
                    return this.remainingTime / this.total * 100 + '%';

                }

            },
            loadQuestions(){
                axios.get("/api/quiz/"+this.quizid1).
                then( ({ data }) => (
                    this.questions = data.data.questions,
                        this.timer = data.data.time * 60,
                        this.quizId = data.data.id,
                        this.total = this.timer,
                        this.getTime(this)


                ) )
            },
            getTime(){


                let interval = setInterval( () => {
                    this.minutes = parseInt(this.timer / 60, 10);
                    this.seconds = parseInt(this.timer % 60, 10);
                    this.minutes = this.minutes < 10 ? "0" + this.minutes : this.minutes;
                    this.seconds = this.seconds < 10 ? "0" + this.seconds : this.seconds;

                    if (--this.timer <0 ) {
                        // this.timer = 0;
                        this.totalTime();
                        clearInterval(interval);
                    }
                    else{
                        this.remainingTime++;
                        this.returnTimerWidth();
                    }
                }, 1000);
            },
            totalTime(){

                this.minutesTaken = parseInt(this.remainingTime / 60, 10);
                this.secondsTaken = parseInt(this.remainingTime % 60, 10);
                this.minutesTaken = this.minutesTaken < 10 ? "0" + this.minutesTaken : this.minutesTaken;
                this.secondsTaken = this.secondsTaken < 10 ? "0" + this.secondsTaken : this.secondsTaken;

            },
            calculateScore(){
                return this.right;
            },
            storeMarks(){
                axios.post('/saveMarks', {
                    marks: this.calculateScore(),
                    quiz_id: this.quizId
                })
                    .then(function (response) {
                        window.location.href = '/results';
                    })
                    .catch(function () {
                        // console.log(error);
                    });
            }


        },
        created() {

            this.loadQuestions();

        }

    }
</script>

