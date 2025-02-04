<?php
if (!function_exists('inputText')) {
    /**
     * Custom Input Form
     *
     * @param string $name       Nama input
     * @param string $value      Nilai default input
     * @param string $errors     Pesan error jika ada
     * @param string $type       Tipe input (default: text)
     * @param string $ph         Placeholder untuk input
     * @param string $label      Label untuk input
     * @param array  $attributes Atribut tambahan untuk input
     * @return string
     */
    function inputText(
        string $name = '',
        string $value = '',
        string $errors = '',
        string $type = 'text',
        string $ph = '',
        string $label = '',
        string $cls = '',
        array $attributes = []
    ): string {
        $attrString = '';
        foreach ($attributes as $key => $val) {
            $attrString .= $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '" ';
        }
        $errorClass = $errors ? 'is-invalid' : '';
        $idInput = $type === 'file' ? 'image' : $name;
        return '
            <div class="form-group">
                <label for="' . htmlspecialchars($name, ENT_QUOTES) . '">' . htmlspecialchars($label, ENT_QUOTES) . '</label>
                <input type="' . htmlspecialchars($type, ENT_QUOTES) . '" 
                       class="form-control rounded-0 ' . $errorClass . '" 
                       id="' . htmlspecialchars($idInput, ENT_QUOTES) . '" 
                       name="' . htmlspecialchars($name, ENT_QUOTES) . '" 
                       placeholder="' . htmlspecialchars($ph, ENT_QUOTES) . '" 
                       value="' . htmlspecialchars(old($name, $value), ENT_QUOTES) . '" 
                       ' . $attrString . '/>
                ' . ($errors ? '<small class="form-text text-danger">' . htmlspecialchars($errors, ENT_QUOTES) . '</small>' : '') . '
            </div>
        ';
    }
}

if (!function_exists('inputTextIdr')) {
    /**
     * Custom Input Form untuk Mata Uang (Rupiah)
     *
     * @param string $name       Nama input
     * @param string $value      Nilai default input
     * @param string $errors     Pesan error jika ada
     * @param string $ph         Placeholder untuk input
     * @param string $label      Label untuk input
     * @param array  $attributes Atribut tambahan untuk input
     * @return string
     */
    function inputTextIdr(
        string $name = '',
        string $value = '',
        string $errors = '',
        string $ph = 'Rupiah',
        string $id = 'idrformat',
        string $label = '',
        array $attributes = []
    ): string {
        $attrString = '';
        foreach ($attributes as $key => $val) {
            $attrString .= $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '" ';
        }
        $errorClass = $errors ? 'is-invalid' : '';

        return '
            <div class="form-group">
                <label for="' . htmlspecialchars($name, ENT_QUOTES) . '">' . htmlspecialchars($label, ENT_QUOTES) . '</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                    </div>
                    <input type="text" 
                           class="form-control rounded-0 ' . $errorClass . '" 
                           id="idrformat" 
                           name="' . htmlspecialchars($name, ENT_QUOTES) . '" 
                           placeholder="' . htmlspecialchars($ph, ENT_QUOTES) . '" 
                           value="' . htmlspecialchars(old($name, $value), ENT_QUOTES) . '" 
                           ' . $attrString . '/>
                </div>
                ' . ($errors ? '<small class="form-text text-danger">' . htmlspecialchars($errors, ENT_QUOTES) . '</small>' : '') . '
            </div>
        ';
    }
}

if (!function_exists('inputUpload')) {
    /**
     * Custom Input Upload for Image with Drag and Drop
     *
     * @param string $name       Name of the input field
     * @param string $value      Default value of the input
     * @param string $errors     Error message, if any
     * @param string $label      Label for the input
     * @param array  $attributes Additional attributes for the input
     * @param string $defaultFile URL of the default file
     * @return string
     */
    function inputUpload(
        string $name = '',
        string $value = '',
        string $errors = '',
        string $label = '',
        array $attributes = [],
        string $defaultFile = ''
    ): string {
        $attrString = '';
        foreach ($attributes as $key => $val) {
            $attrString .= $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '" ';
        }
        $errorClass = $errors ? 'is-invalid' : '';
        $defaultFileAttr = $defaultFile ? 'data-default-file="' . htmlspecialchars($defaultFile, ENT_QUOTES) . '"' : '';
        return '
        <div class="form-group">
            ' . ($label ? '<label for="' . htmlspecialchars($name, ENT_QUOTES) . '">' . htmlspecialchars($label, ENT_QUOTES) . '</label>' : '') . '
            <input 
                type="file" 
                id="' . htmlspecialchars($name, ENT_QUOTES) . '" 
                class="dropify ' . $errorClass . '" 
                name="' . htmlspecialchars($name, ENT_QUOTES) . '" 
                accept="image/*" 
                ' . $defaultFileAttr . ' 
                ' . $attrString . '>
            ' . ($errors ? '<small class="form-text text-danger">' . htmlspecialchars($errors, ENT_QUOTES) . '</small>' : '') . '
        </div>
        ';
    }
}

if (!function_exists('modal')) {
    /**
     * Generate a Bootstrap Modal
     *
     * @param string $id ID untuk modal
     * @param string $title Judul modal
     * @param string $body Isi/body modal
     * @param string $action URL untuk form action (kosong jika tidak menggunakan form)
     * @param string $footer Isi/footer modal (opsional)
     * @param array $options Opsi tambahan (misalnya `size`, `close_button`, dll.)
     * @return string
     */
    function modal(
        string $id,
        string $title,
        string $body,
        string $action = '',
        string $footer = '',
        array $options = []
    ): string {
        // Opsi default
        $size = $options['size'] ?? ''; // `modal-lg`, `modal-sm`, atau kosong untuk ukuran default
        $close_button = $options['close_button'] ?? true; // Apakah tombol close ditampilkan

        // Awal dan akhir form jika action disediakan
        $form_start = $action ? form_open($action, ['method' => 'POST', 'enctype' => 'multipart/form-data']) : '';
        $form_end = $action ? form_close() : '';

        // Tombol footer default jika footer tidak diberikan
        if (empty($footer)) {
            $footer = '
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            ';
        }

        // Render modal
        return '
        <div id="' . htmlspecialchars($id, ENT_QUOTES) . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="' . htmlspecialchars($id . '_label', ENT_QUOTES) . '" aria-hidden="true">
            <div class="modal-dialog ' . htmlspecialchars($size, ENT_QUOTES) . '" role="document">
                <div class="modal-content">
                    ' . $form_start . '
                    <div class="modal-header">
                        <h5 class="modal-title" id="' . htmlspecialchars($id . '_label', ENT_QUOTES) . '">' . htmlspecialchars($title, ENT_QUOTES) . '</h5>
                        ' . ($close_button ? '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : '') . '
                    </div>
                    <div class="modal-body">
                        ' . $body . '
                    </div>
                    <div class="modal-footer">
                        ' . $footer . '
                    </div>
                    ' . $form_end . '
                </div>
            </div>
        </div>
        ';
    }
}

if (!function_exists('inputSelect')) {
    /**
     * Generate a dynamic HTML select element
     *
     * @param string $name Nama atribut `name` untuk elemen select
     * @param array $options Pilihan dalam bentuk array ['value' => 'label'] atau [['value' => ..., 'label' => ...]]
     * @param mixed $selected Nilai yang dipilih (opsional)
     * @param string $title Label untuk select element
     * @param string $errors Pesan error jika ada
     * @param array $attributes Atribut tambahan untuk elemen select (opsional)
     * @return string HTML select element
     */
    function inputSelect(
        string $name = '',
        array $options = [],
        string $selected = '',
        string $title = '',
        string $errors = '',
        array $attributes = []
    ): string {
        // Generate additional attributes string
        $attrString = '';
        foreach ($attributes as $key => $val) {
            $attrString .= htmlspecialchars($key, ENT_QUOTES) . '="' . htmlspecialchars($val, ENT_QUOTES) . '" ';
        }

        // Error class for invalid input
        $errorClass = $errors ? 'is-invalid' : '';

        // Start building the select HTML
        $html = '
        <div class="form-group">
            <label for="' . htmlspecialchars($name, ENT_QUOTES) . '">' . htmlspecialchars($title, ENT_QUOTES) . '</label>
            <select
                class="form-control ' . $errorClass . '"
                id="' . htmlspecialchars($name, ENT_QUOTES) . '"
                name="' . htmlspecialchars($name, ENT_QUOTES) . '" ' . $attrString . '>
                <option value="">Pilih ' . htmlspecialchars($title, ENT_QUOTES) . '</option>';

        // Populate options dynamically
        foreach ($options as $key => $option) {
            // Handle both simple and complex option structures
            $value = is_array($option) ? $option['value'] : $key;
            $label = is_array($option) ? $option['label'] : $option;
            $isSelected = ($value == $selected) ? 'selected' : '';
            $html .= '<option value="' . htmlspecialchars($value, ENT_QUOTES) . '" ' . $isSelected . '>' . htmlspecialchars($label, ENT_QUOTES) . '</option>';
        }

        // Close the select tag
        $html .= '
            </select>';

        // Add error message if exists
        if ($errors) {
            $html .= '<small class="form-text text-danger">' . htmlspecialchars($errors, ENT_QUOTES) . '</small>';
        }

        // Close the form group
        $html .= '
        </div>';

        return $html;
    }
}

if (!function_exists('btn_submit')) {
    /**
     * Generate submit and cancel buttons
     *
     * @param string $href URL untuk tombol batal
     * @param array $attributes Atribut tambahan untuk tombol
     * @return string HTML untuk tombol
     */
    function btn_submit(
        string $href = '#',
        array $attributes = []
    ): string {
        return '
        <div class="float-right">
            <a href="' . htmlspecialchars($href, ENT_QUOTES) . '" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        ';
    }
}


if (!function_exists('inputRadio')) {
    /**
     * Generate a radio input group with options
     *
     * @param string $errors Error message to display
     * @param string $title Title or label for the group
     * @param array $options Array of radio options (name, id, value, title_option)
     * @param mixed $selected Value of the selected option (for checking "checked" state)
     * @return string Rendered HTML for the radio group
     */
    function inputRadio(
        string $errors = '',
        string $title = '',
        array $options = [],
        string $selected = '' // Added $selected to handle the old value
    ): string {
        $html = '<div class="form-group mb-3">';
        $html .= '<label>' . htmlspecialchars($title, ENT_QUOTES) . '</label>';
        $html .= '<div class="form-group d-flex">'; // Container for the radio buttons

        foreach ($options as $option) {
            // Check if the current option value is selected
            $isChecked = ($option['value'] == $selected) ? 'checked' : '';

            $html .= '
            <div class="form-check mx-2 my-0 ">
                <label class="form-check-label">
                    <input 
                        type="radio" 
                        name="' . htmlspecialchars($option['name'], ENT_QUOTES) . '" 
                        id="' . htmlspecialchars($option['id'], ENT_QUOTES) . '" 
                        class="form-check-input" 
                        value="' . htmlspecialchars($option['value'], ENT_QUOTES) . '" 
                        ' . $isChecked . '
                    >
                    ' . htmlspecialchars($option['title_option'], ENT_QUOTES) . '
                    <i class="input-helper"></i>
                </label>
            </div>';
        }

        $html .= '</div>'; // Close the container

        // Display error message if any
        if ($errors) {
            $html .= '<small class="form-text text-danger">' . htmlspecialchars($errors, ENT_QUOTES) . '</small>';
        }

        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('inputSelectTwo')) {
    /**
     * Generate a dynamic HTML select element using Select2
     *
     * @param string $name Nama atribut `name` untuk elemen select
     * @param array $options Pilihan dalam bentuk array ['value' => 'label'] atau [['value' => ..., 'label' => ...]]
     * @param mixed $selected Nilai yang dipilih (opsional)
     * @param string $title Label untuk select element
     * @param string $errors Pesan error jika ada
     * @param array $attributes Atribut tambahan untuk elemen select (opsional)
     * @return string HTML select element
     */
    function inputSelectTwo(
        string $name = '',
        array $options = [],
        string $selected = '',
        string $title = '',
        string $errors = '',
        array $attributes = []
    ): string {
        // Generate additional attributes string
        $attrString = '';
        foreach ($attributes as $key => $val) {
            $attrString .= htmlspecialchars($key, ENT_QUOTES) . '="' . htmlspecialchars($val, ENT_QUOTES) . '" ';
        }

        // Error class for invalid input
        $errorClass = $errors ? 'is-invalid' : '';

        // Start building the select HTML
        $html = '<div class="form-group">';
        $html .= '<label for="' . htmlspecialchars($name, ENT_QUOTES) . '">' . htmlspecialchars($title, ENT_QUOTES) . '</label>';
        $html .= '<select class="form-control select-two ' . $errorClass . '" id="' . htmlspecialchars($name, ENT_QUOTES) . '" name="' . htmlspecialchars($name, ENT_QUOTES) . '" ' . $attrString . '>';
        $html .= '<option value="">Pilih ' . htmlspecialchars($title, ENT_QUOTES) . '</option>';

        // Populate options dynamically
        foreach ($options as $key => $option) {
            $value = is_array($option) ? $option['value'] : $key;
            $label = is_array($option) ? $option['label'] : $option;
            $isSelected = ($value == $selected) ? 'selected' : '';
            $html .= '<option value="' . htmlspecialchars($value, ENT_QUOTES) . '" ' . $isSelected . '>' . htmlspecialchars($label, ENT_QUOTES) . '</option>';
        }

        $html .= '</select>';

        // Add error message if exists
        if ($errors) {
            $html .= '<small class="form-text text-danger">' . htmlspecialchars($errors, ENT_QUOTES) . '</small>';
        }

        $html .= '</div>'; // Close form-group
        return $html;
    }
}
