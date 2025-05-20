<?php

$fields = [
    'TextBased' => ['text', 'password', 'email', 'search', 'tel', 'url'],
    'MultilineText' => ['textarea'],
    'Numeric' => ['number', 'range'],
    'DateAndTime' => ['date', 'datetime-local', 'month', 'time', 'week'],
    'FileBased' => ['file', 'image'],
    'Choice' => ['checkbox', 'radio'],
    'OptionalChoice' => ['select'],
    'other' => ['submit', 'reset', 'button', 'color', 'hidden']
];

foreach (array_keys($fields) as $key) {
    $className = $key;
    $filePath = __DIR__ . "/$key.php";

    $fileContent = <<<PHP
<?php

namespace form;

class $className extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for $className fields
        return '<input type="text" name="' . (\$this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>
PHP;

    file_put_contents($filePath, $fileContent);
    echo "Created file: $filePath\n";
}