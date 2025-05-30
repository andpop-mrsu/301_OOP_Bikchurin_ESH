$excel = New-Object -ComObject Excel.Application
$excel.Visible = $false
$workbook = $excel.Workbooks.Add()
$sheet = $workbook.Sheets.Item(1)

$sheet.Range('B2').Value2 = 'Привет от PowerShell'
$sheet.Range('B2').Font.Size = 12
$sheet.Range('B2').Font.Italic = $true

$user = $env:USERNAME
$comp = $env:COMPUTERNAME
$filename = "$user`_$comp.xlsx"
$path = Join-Path ([Environment]::GetFolderPath('Desktop')) $filename

$workbook.SaveAs($path)
$excel.Quit()

Write-Host "Excel file saved to: $path"