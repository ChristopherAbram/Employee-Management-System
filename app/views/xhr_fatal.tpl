{section name=err loop=$messages step=1}
<h1>{$head.error}</h1>
<p>
<b>{$head.message}:</b> {$messages[err].message}<br>
<b>{$head.file}:</b> {$messages[err].file}<br>
<b>{$head.line}:</b> {$messages[err].line}<br>
<b>{$head.code}:</b> {$messages[err].code}<br>
</p>
{/section}