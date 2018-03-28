function JobSeekerStep() {

    var job = {};

    job.step = [
        {valid: true, url: '/Site/FormStepOne',oldHTML:null},
        {valid: false, url: '/Site/FormStepTwo',oldHTML:null},
        {valid: false, url: '/Site/FormStepThree',oldHTML:null}
    ];

    function updateStep() {
        job.step.map(function (t, step) {
            if (t['valid']) {
                $('.job-seeker-list li a[data-step="' + step + '"]').parent().addClass('active');
            }
        });

    }

    function loadStep(step) {
        loadLayoutByAjax(job.step[step]['url'], function (html) {
            $('.loadStep')
                .html('')
                .html(html);

            updateStep();
        })
    }

    $('.job-seeker-list li a').on('click', function (evt) {

        evt.preventDefault();
        var $this = $(this);
        var $step = $this.data('step');

        if (job.step[$step]['valid']) {
            $this.parent().addClass('active');
            loadStep($step)
        }

    });

    loadStep(0);

    job.next = function (step) {
        job.step[step]['valid'] = true;
        updateStep();
        loadStep(step);
    };

    return job;
}