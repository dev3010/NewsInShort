protected function schedule (Schedule $schedule)
{
    $schedule->command('news:fetch')-> hourly();
}