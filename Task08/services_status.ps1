Get-Service |
    Select-Object Name, Status |
    ForEach-Object {
        if ($_.Status -eq 'Running') {
            Write-Host "$($_.Name)`t$($_.Status)" -ForegroundColor Green
        } elseif ($_.Status -eq 'Stopped') {
            Write-Host "$($_.Name)`t$($_.Status)" -ForegroundColor Red
        } else {
            Write-Host "$($_.Name)`t$($_.Status)"
        }
    }

    