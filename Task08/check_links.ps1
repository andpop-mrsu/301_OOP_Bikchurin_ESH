chcp 65001 > $null
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$shell = New-Object -ComObject WScript.Shell
$desktop = [Environment]::GetFolderPath('Desktop')
$badDir = Join-Path $desktop 'BadLinks'
if (-not (Test-Path $badDir)) {
    New-Item -Path $badDir -ItemType Directory | Out-Null
}

$total = 0
$moved = 0

Write-Host "Проверка ярлыков в папке: $desktop"

Get-ChildItem -Path $desktop -Filter '*.lnk' | ForEach-Object {
    $total++
    $lnk = $_.FullName
    $shortcut = $shell.CreateShortcut($lnk)
    $target = $shortcut.TargetPath
    if (-not (Test-Path $target)) {
        Move-Item -Path $lnk -Destination $badDir
        Write-Host "Перемещен битый ярлык: $($_.Name)" -ForegroundColor Yellow
        $moved++
    }
}

Write-Host "Проверено ярлыков: $total" -ForegroundColor Cyan
Write-Host "Перемещено битых: $moved" -ForegroundColor Magenta