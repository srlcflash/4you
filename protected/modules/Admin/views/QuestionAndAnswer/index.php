
<div class="row">
    <div class="col s12">
        <div class="card ">
            <div class="card-content">
                <h5 class="grey-text text-darken-1">Question & Answer</h5>

                <div class="row question-wrapper">
                    <div class="col s12 ">
                        <div class="row">

                            <div class="col s12">
                                <button class="cm-btn add right addNewQuestion"><i class="material-icons left">
                                        &#xE148;</i>Add
                                    New
                                </button>
                            </div>

                            <div class="col s12 question-items">
                                <div class="row row-question">
                                    <div class="col s12">

                                        <div class="row">
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input type="text">
                                                    <label>Question</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col s6">

                                                <div class="row">
                                                    <div class="col s12">
                                                        <div class="col s12">
                                                            <button class="cm-btn add right btnAddAnswer"><i
                                                                    class="material-icons left">&#xE148;</i>
                                                                Add New Answer
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-answer">
                                                    <div class="col s12 input-no-label">
                                                        <input type="text" placeholder="Answer">
                                                    </div>
                                                    <div class="col s12 input-no-label">
                                                        <input type="text" placeholder="Answer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="card-action right-align">
                <button type="button" class=" btn waves-effect waves-light red lighten-1 btnCleanForm">Clear</button>
                <button type="submit" class="btn waves-effect waves-light blue lighten-1">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="card-panel detail-card outer-tb-15">
    <div class="row mb-0">
        <div class="col s8">
            <h6 class="grey-text text-darken-1 ">How many lorem ipsum </h6>
        </div>
        <div class="col s4">
            <button class="cm-btn right">
                <i class="material-icons red-text mr-0">delete</i>
            </button>
            <button class="cm-btn right">
                <i class="material-icons grey-text">edit</i>
            </button>
        </div>
    </div>
</div>

<!-- ===========================================================================
        Custom Script
============================================================================ -->
<script>

    // Add New Question
    $('.addNewQuestion').on('click', function () {
        loadQuestion();
    });

    //Delete Question
    $(document).on('click', '.btnDeleteQuestion', function () {
        var _rowQuestion = $(this).parents('.row-question');

        if (_rowQuestion.prop('id')) {
            //Remove server
        }
        _rowQuestion.remove();

    });

    //Add new answer
    $(document).on('click', '.btnAddAnswer', function () {
        var _answerWrapper = $(this).parents('.answer-area');
        loadAnswerInput(_answerWrapper.find('.row-answer'));
    });

    //Delete answer
    $(document).on('click', '.btnDeleteAnswer', function () {
        var _inputWrapper = $(this).parents('.input-no-label');
        if(_inputWrapper.prop('id')) {}

        _inputWrapper.remove();
    });

    //Clear Form
    $('.btnCleanForm').on('click',function () {
        loadQuestion(true);
    });

</script>

<!-- ===========================================================================
        Backend Script
============================================================================ -->
<script>

    (function () {
        //Page Load
        loadQuestion(true);
    })();


    function loadQuestion() {

        //Clean Status
        var isClean = arguments[0];

        $.ajax({
            type: 'GET',
            data: '',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/QuestionAndAnswer/LoadQuestion';?>",
            success: function (res) {
                var appendEle = $('.question-items');

                if (isClean) {
                    appendEle.html('').html(res);
                    return;
                }

                appendEle.append(res);
            }
        });

    }

    //Load Answer input
    function loadAnswerInput(_appendEle) {

        //Clean Status
        var isClean = arguments[1];

        $.ajax({
            type: 'GET',
            data: '',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/QuestionAndAnswer/LoadAnswerInput';?>",
            success: function (res) {
                var appendEle = $(_appendEle);

                if (isClean) {
                    appendEle.html('').html(res);
                    return;
                }

                appendEle.append(res);
            }
        });

    }
</script>