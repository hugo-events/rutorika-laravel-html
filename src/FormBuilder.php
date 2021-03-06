<?php

namespace Rutorika\Html;
use Rutorika\Html\Theme\Themable;
use StringTemplate\Engine;

/**
 * Form builder, provides *Field methods for twitter bootstrap forms.
 *
 * @TODO [column|label|buttonOffset]Width options
 *
 * Class FormBuilder
 */
class FormBuilder extends \Collective\Html\FormBuilder
{
    /**
     * @var Themable
     */
    protected $theme;

    /**
     * The reserved form open attributes.
     *
     * @var array
     */
    protected $reserved = ['method', 'url', 'route', 'action', 'files', 'theme'];

    /**
     * @param array $options
     *
     * @return string
     */
    public function open(array $options = [])
    {
        $themeName = array_get($options, 'theme', config('rutorika-form.theme'));
        $themeClass = config('rutorika-form.themes.' . $themeName);

        $this->theme = new $themeClass($this);
        $options = $this->theme->updateOptions($options);

        return parent::open($options);
    }

    public function textField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->text($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function passwordField($title, $name, $options = array(), $help = '')
    {
        $control = $this->password($name, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function checkboxField($title, $name, $value = 1, $checked = null, $options = [], $help = '')
    {
        $control = '<div class="checkbox"><label>' . $this->checkbox($name, $value, $checked, $options) . '</label></div>';

        return $this->field($title, $name, $control, $help);
    }

    public function booleanField($title, $name, $value = 1, $checked = null, $options = [], $help = '')
    {
        $control = '<div class="checkbox"><label>' . $this->boolean($name, $value, $checked, $options) . '</label></div>';

        return $this->field($title, $name, $control, $help);
    }

    public function textareaField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->textarea($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function hiddenField($title, $name, $value = null, $options = [], $help = '')
    {
        $control = $this->hidden($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function numberField($title, $name, $value = null, $options = [], $help = '')
    {
        $control = $this->number($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function selectField($title, $name, $list = [], $selected = null, $options = [], $help = '')
    {
        $control = $this->select($name, $list, $selected, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    /**
     * Code textarea field (Ace redactor will be applied to this field).
     *
     * available options:
     * mode : 'php'
     * theme: 'monokai'
     *
     * @param $title
     * @param $name
     * @param null $value
     * @param array $options
     * @param string $help
     *
     * @return string
     */
    public function codeField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->code($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function colorField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->color($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function geopointField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->geopoint($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function imageUploadMultipleField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->imageUploadMultiple($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function imageUploadField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->imageUpload($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function fileUploadField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->fileUpload($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function imageField($title, $name, $value = null, $options = array(), $help = '')
    {
        return $this->imageUploadField($title, $name, $value, $options, $help);
    }

    public function audioUploadField($title, $name, $value = null, $options = array(), $help = '')
    {
        return $this->audioField($title, $name, $value, $options, $help);
    }

    public function audioField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->audioUpload($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function fileField($title, $name, $value = null, $options = array(), $help = '')
    {
        return $this->fileUploadField($title, $name, $value, $options, $help);
    }

    public function staticField($title, $value, $help = '')
    {
        $name = 'static-' . uniqid();
        $control = '<p class="form-control-static">' . $value . '</p>';

        return $this->field($title, $name, $control, $help);
    }

    public function select2Field($title, $name, $list = [], $selected = null, $options = [], $help = '')
    {
        $control = $this->select2($name, $list, $selected, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function datetimeField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->datetimePicker($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function dateField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->datePicker($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function timeField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->timePicker($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function datetimePicker($name, $value = null, $options = array())
    {
        $defaultDateTimeOptions = config('rutorika-form.datetime', []);

        $datetimeOptions = array_get($options, 'datetime', []);
        $datetimeOptions = array_merge(['locale' => config('app.locale')], $defaultDateTimeOptions, $datetimeOptions);

        $options['datetime'] = $datetimeOptions;

        $options = $this->provideOptionToHtml('datetime', $options);
        $template = '
        <div class="input-group date rk-datetimepicker">
            %s
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>';
        return sprintf($template, $this->text($name, $value, $options));
    }

    public function datePicker($name, $value = null, $options = array())
    {
        $datetimeOptions = array_get($options, 'datetime', []);
        $datetimeOptions = array_merge(['format' => 'L'], $datetimeOptions);

        $options['datetime'] = $datetimeOptions;

        return $this->datetimePicker($name, $value, $options);
    }

    public function timePicker($name, $value = null, $options = array())
    {
        $datetimeOptions = array_get($options, 'datetime', []);
        $datetimeOptions = array_merge(['format' => 'LT'], $datetimeOptions);

        $options['datetime'] = $datetimeOptions;

        return $this->datetimePicker($name, $value, $options);
    }

    public function select2($name, $list = [], $selected = null, $options = [])
    {
        $options = $this->appendClassToOptions('rk-select2', $options);

        if (isset($options['select2'])) {
            foreach ($options['select2'] as $key => $value) {
                $options = $this->addHtmlOption($key, $value, $options);
            }
            unset($options['select2']);
        }
        $options['data-value'] = json_encode($selected);

        return $this->select($name, $list, $selected, $options);
    }


    /* INPUTS */

    public function boolean($name, $value = 1, $checked = null, $options = [])
    {
        return '<input type="hidden" name="' . $name . '" value="0" />' . $this->checkbox($name, $value, $checked, $options);
    }

    public function code($name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('hidden', $options);
        $options = $this->appendClassToOptions('rk-code-field', $options);
        $options = $this->provideOptionToHtml('mode', $options);
        $options = $this->provideOptionToHtml('theme', $options);

        return $this->textarea($name, $value, $options) . '<div class="rk-code"></div>';
    }

    public function color($name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('rk-color-field', $options);
        $options = $this->provideOptionToHtml('minicolors', $options);

        return $this->text($name, $value, $options);
    }

    public function geopoint($name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('rk-geopoint-field', $options);
        $options = $this->provideOptionToHtml('map', $options);
        $options = $this->provideOptionToHtml('layer', $options);
        $options = $this->provideOptionToHtml('type', $options);

        return '<div class="rk-map"></div>' . $this->text($name, $value, $options);
    }

    public function imageUpload($name, $value = null, $options = [])
    {
        $previewTemplate = '<a href="{fileSrc}"><img src="{fileSrc}" /></a>';

        return $this->renderUpload($previewTemplate, $name, $value, $options);
    }

    public function imageUploadMultiple($name, $value = null, $options = [])
    {
        $previewTemplate = '<div class="rk-upload-item" data-filename="{filename}">
            <a href="{fileSrc}" class="thumb" style="background-image: url({fileSrc})"></a>
            <p><span class="btn btn-default btn-sm sortable-handle"><i class="glyphicon glyphicon-resize-horizontal"></i></span>
            <span class="btn btn-default btn-sm pull-right rk-upload-remove"><i class="glyphicon glyphicon-trash"></i></span></p>
          </div>';

        return $this->renderUploadMultiple($previewTemplate, $name, $value, $options);
    }

    public function audioUpload($name, $value = null, $options = [])
    {
        $previewTemplate = '<a href="{fileSrc}"><audio src="{fileSrc}" controls></audio></a>';

        $options = array_merge(['type' => 'audio'], $options);

        return $this->renderUpload($previewTemplate, $name, $value, $options);
    }

    public function fileUpload($name, $value = null, $options = [])
    {
        return $this->renderUpload('', $name, $value, $options);
    }

    public function renderUpload($previewTemplate, $name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('rk-uploader-field', $options);
        $options = $this->appendClassToOptions('hidden', $options);

        $options = $this->provideOptionToHtml('url', $options);
        $options = $this->provideOptionToHtml('type', $options);

        $template = $this->theme->getUploadTemplate($previewTemplate);

        $fileValue = $this->getValueAttribute($name, $value);

        $templateEngine = new Engine();

        return $templateEngine->render($template, [
            'fileSrc' => $this->fileSrc($fileValue),
            'fileField' => $this->file(null, [])
        ]) . $this->text($name, $value, $options);
    }

    public function renderUploadMultiple($previewTemplate, $name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('rk-uploader-field', $options);
        $options = $this->appendClassToOptions('rk-uploader-multiple-field', $options);
        $options = $this->appendClassToOptions('hidden', $options);

        $options = $this->provideOptionToHtml('url', $options);
        $options = $this->provideOptionToHtml('type', $options);

        $fileValue = $this->getValueAttribute($name, $value);
        $files = strlen($fileValue) > 0 ? explode(':', $fileValue) : [];

        $previewItemsTemplate = '';
        $templateEngine = new Engine();

        foreach ($files as $file) {
            $previewItemsTemplate .= $templateEngine->render($previewTemplate, [
                'fileSrc' => $this->fileSrc($file),
                'filename' => $file
            ]);
        }

        $template = $this->theme->getUploadMultipleTemplate($previewItemsTemplate);

        $itemTemplate = '<script type="text/x-template" id="rk-item-template">' . $previewTemplate .  '</script>';

        return $templateEngine->render($template, [
            'fileSrc' => $this->fileSrc($fileValue),
            'fileField' => $this->file(null, ['multiple'])
        ]) . $this->text($name, $value, $options) . $itemTemplate;
    }

    public function field($title, $name, $control = '', $help = '')
    {
        $errors = $name && $this->session ? $this->session->get('errors') : null;

        return $this->theme->field($title, $name, $control, $errors, $help);
    }

    public function submitField($title = 'Submit')
    {
        return $this->field(null, null, '<button type="submit" class="btn btn-primary">' . $title . '</button>');
    }

    protected function setDefaultOptions($options)
    {
        return $this->appendClassToOptions('form-control', $options);
    }

    protected function appendClassToOptions($class, array $options = [])
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' ' : '';
        $options['class'] .= $class;

        return $options;
    }

    /**
     * @param string $optionName
     * @param array  $options
     *
     * @param null   $defaultValue
     *
     * @return mixed
     */
    protected function provideOptionToHtml($optionName, $options, $defaultValue = null)
    {
        if (isset($options[$optionName])) {
            $options = $this->addHtmlOption($optionName, $options[$optionName], $options);
            unset($options[$optionName]);
        } elseif ($defaultValue !== null) {
            $options['data-' . $optionName] = $defaultValue;
        }

        return $options;
    }

    protected function addHtmlOption($optionName, $optionValue, $options){
        $options['data-' . $optionName] = is_scalar($optionValue) ? $optionValue : json_encode($optionValue);

        return $options;
    }

    protected function fileSrc($filename)
    {
        return stored_file_src($filename);
    }
}
