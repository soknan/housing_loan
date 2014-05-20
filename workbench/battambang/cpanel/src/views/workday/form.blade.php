@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

<?php
echo Former::open($form_action)->method($form_method);
echo FormPanel2::make(
    'General',
    Former::select('work_week', 'Work Week')
        ->options(array('MF' => 'Monday Friday', 'MS' => 'Monday Saturday'), $form->work_week)
        ->required()
        ->placeholder('- Select One -') . ''
    .Former::select('work_month', 'Work Month')
        ->options(array(25 => '01-25', 26 => '01-26', 27 => '01-27', 28 => '01-28'), $form->work_month)
        ->required()
        ->placeholder('- Select One -') . ''
    ,
    Former::textarea('work_time', 'WorkTime', $form->work_time)
        ->required() . ''
    .Former::text('activated_at', 'Activated Date', date('d-m-Y', strtotime($form->activated_at)))
        ->required()
        ->placeholder(' dd-mm-yyyy')
        ->append('<span class="glyphicon glyphicon-calendar"></span>')
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop

@section('js')
<?php echo DatePicker::make('activated_at'); ?>
@stop
