function Show-Date_Info {
    $now = Get-Date
    $day = $now.Day
    $month = $now.Month
    $year = $now.Year
    Write-Host "Сегодня: $($now.ToString('dd.MM.yyyy'))"

    try {
        $dayFact = Invoke-RestMethod -Uri "http://numbersapi.com/$day/math?json"
        $monthFact = Invoke-RestMethod -Uri "http://numbersapi.com/$month/math?json"
        $yearFact = Invoke-RestMethod -Uri "http://numbersapi.com/$year/math?json"

        Write-Host "$($dayFact.text)"
        Write-Host "$($monthFact.text)"
        Write-Host "$($yearFact.text)"
    } catch {
        Write-Error "Не удалось получить данные с numbersapi.com: $_"
    }
}

Show-Date_Info