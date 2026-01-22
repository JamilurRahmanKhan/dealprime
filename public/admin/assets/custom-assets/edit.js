$(document).ready(function() {
    $('#imageInput').change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreview').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
});

// -----------------------------------------------------------------------------------------------------

// custom dropdown code here
        $(document).ready(function() {
            function setupSearchableDropdown(searchInputId, optionSearchInputId, dropdownMenuSelector) {
                var $searchInput = $('#' + searchInputId);
                var $optionSearchInput = $('#' + optionSearchInputId);
                var $dropdownMenu = $searchInput.siblings(dropdownMenuSelector);
                var $options = $dropdownMenu.find('.dropdown-item');

                $searchInput.on('click', function() {
                    $dropdownMenu.toggle();
                    $optionSearchInput.val('');
                    $options.show();
                    $optionSearchInput.focus();
                });

                $options.on('click', function() {
                    var value = $(this).data('value');
                    var text = $(this).text();
                    $searchInput.val(text);
                    $searchInput.data('value', value);
                    $dropdownMenu.hide();
                });

                $optionSearchInput.on('keyup', function() {
                    var filter = $optionSearchInput.val().toLowerCase();
                    $options.each(function() {
                        var text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(filter) > -1);
                    });
                });

                $(document).on('click', function(event) {
                    if (!$(event.target).closest('.searchable-dropdown').length) {
                        $dropdownMenu.hide();
                    }
                });
            }
            setupSearchableDropdown('search-input-category', 'option-search-input-category', '.dropdown-menu');
            setupSearchableDropdown('search-input-sub_category', 'option-search-input-sub_category', '.dropdown-menu');
            setupSearchableDropdown('search-input-sub_subcategory', 'option-search-input-sub_subcategory', '.dropdown-menu');
            setupSearchableDropdown('search-input-brand', 'option-search-input-brand', '.dropdown-menu');
            setupSearchableDropdown('search-input-unit', 'option-search-input-unit', '.dropdown-menu');
            setupSearchableDropdown('search-input-product', 'option-search-input-product', '.dropdown-menu');
        // });

// ------------------------------------------------------------------------------------------
                    //dependent category and subcategory code  code
                    // $(document).ready(function () {
                    //     // Category selection
                    //     $('.category-item').on('click', function () {
                    //         var categoryId = $(this).data('id');
                    //         var categoryName = $(this).text();

                    //         $('#search-input-category').val(categoryName);
                    //         $('#category-id').val(categoryId);

                    //         // Hide the dropdown
                    //         $('.dropdown-menu').removeClass('show');

                    //         // Clear the subcategory input and hidden field
                    //         $('#search-input-sub_category').val('');
                    //         $('#sub-category-id').val('');
                    //         $('#subcategory-list').empty();

                    //         // Load subcategories
                    //         loadSubCategories(categoryId);
                    //     });

                    //     // Subcategory search
                    //     $('#option-search-input-sub_category').on('keyup', function () {
                    //         var value = $(this).val().toLowerCase();
                    //         $('#subcategory-list .dropdown-item').filter(function () {
                    //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    //         });
                    //     });
                    // });

                    // function loadSubCategories(categoryId) {
                    //     $.ajax({
                    //         url: '/get-subcategories/' + categoryId, // Modified endpoint to include category ID
                    //         type: 'GET',
                    //         success: function (response) {
                    //             $('#subcategory-list').empty();
                    //             response.subcategories.forEach(function (subcategory) {
                    //                 $('#subcategory-list').append('<a class="dropdown-item subcategory-item" data-id="' + subcategory.id + '">' + subcategory.name + '</a>');
                    //             });

                    //             // Subcategory selection
                    //             $('.subcategory-item').on('click', function () {
                    //                 var subCategoryId = $(this).data('id');
                    //                 var subCategoryName = $(this).text();

                    //                 $('#search-input-sub_category').val(subCategoryName);
                    //                 $('#sub-category-id').val(subCategoryId);

                    //                 // Hide the dropdown
                    //                 $('.dropdown-menu').removeClass('show');
                    //             });
                    //         },
                    //         error: function (error) {
                    //             console.log(error);
                    //         }
                    //     });
                    // }






        // Brand selection
        $('.brand-item').on('click', function() {
            var brandId = $(this).data('id');
            var brandName = $(this).text().trim();
            $('#search-input-brand').val(brandName);
            $('#brand-id').val(brandId);
        });

        // Unit selection
        $('.unit-item').on('click', function() {
            var unitId = $(this).data('id');
            var unitName = $(this).text().trim();
            $('#search-input-unit').val(unitName);
            $('#unit-id').val(unitId);
        });
    });


// -------------------------------------------------------------------------

// single image preview code
$(document).ready(function() {
    $('#image').change(function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').html('<img src="' + e.target.result + '" alt="Image Preview" style="max-width: 90px; height: auto;">');
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
});

// multiple image preview code here
$(document).ready(function () {
        function previewImages(input, container) {
            if (input.files) {
                $(container).empty();
                const filesAmount = input.files.length;
                for (let i = 0; i < filesAmount; i++) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('<div class="col-md-2 mb-3"><img src="' + event.target.result + '" class="img-fluid img-thumbnail "  /></div>').appendTo(container);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        $('#other_image').on('change', function() {
            previewImages(this, '#image_preview');
        });
    });


    // -------------------------------------------------------------------------------------
    // for searchable datatable
    $(document).ready(function() {
        $('#datatable-buttons').DataTable();
    });

// ------------------------------------------------------------------

