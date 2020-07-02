var offsetProducts = 0; //OFFSET THAT USES WHEN USER PICK SORTING OF PRODUCTS
var summCart = 0; //SUM OF PRODUCTS IN USER'S CART
var loginCheck = true; //CHECKING FOR AUTH
var passConfCheck = true; //CHECKING FOR REG

//FUNCTION THAT LET GET COOKIE BY A COOKIE NAME
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

$(document).ready(function() {
    //FUNCTION THAT SROLLS TO TOP WHEN PAGE IS UNLOADS
    this.resetUnload = function()
    {
        scrollTo(0, 0);
        $(window).off('beforeunload', this.unload);
        setTimeout(function(){
            $(window).on('beforeunload', this.unload);
        }, 1000);
    };

    $(document).on('keydown', function(event){
        if((event.ctrlKey && event.keyCode == 116) || event.keyCode == 116){
            this.resetUnload();
        }
    });

    //CALCULATES SIZE OF WINDOW (FOR FOOTER) WHEN WINDOW.RESIZE TOO
    document.getElementById("mainContainer").style.minHeight = innerHeight-$('#header').height()-$('#footer').height()+'px';
    $(window).resize(function () {
        document.getElementById("mainContainer").style.minHeight = innerHeight-$('#header').height()-$('#footer').height()+'px';
        $('#divCart').css('max-height', innerHeight-$('#header').height()*2-$('#footer').height()+'px');
    });

    //SET AN ACTIVE NAV-LINK WHITE COLOR (SET IT ACTIVATED)
    let cat = $(location).attr('pathname').split('/')[1].split('.')[0];
    $(`#${cat}`).addClass('active');

    //LOADS USERS AND FABRICATORS INFORMATION TABLES (FOR ADMINISTRATORS ONLY)
    if($('#profile').hasClass('active')) {
        $('#usersTableDiv').load('../php/loadUsersTable.php');
        $('#fabricatorsTableDiv').load('../php/loadFabricatorsTable.php');
    }

    //SET FOCUS TO FIRST INPUT WHEN MODAL WINDOW SHOWN
    $('#signInBtn').on('click', function () {
        setTimeout( function () {
            $('.modal input[type=text]:first').focus();
        }, 500);
    });

    //SET MODAL WINDOW POSITION (CENTER)
    $('#loadPic').on('show.bs.modal', function () {
        $('#loadPic').css("left", $(window).width() / 2 - $('#loadPic').width() / 2);
    });

    //AJAX SUBMITTING

    //SUBMIT TO CHANGE USER'S PROFILE PHOTO
    $('#formPic').submit(function (event) {
        if($('#inputPic').val()) {
            event.preventDefault();
            $(this).ajaxSubmit({
                target: '#userPicture',
                beforeSubmit: function () {
                    $('#loadIcon').css("display", "block");
                },
                success: function () {
                    $('#loadIcon').css("display", "none");
                    document.location.reload();
                },
                resetForm: true
            });
        }
        return false;
    });

    //SUBMIT TO REGISTRATION/AUTH USER'S
    $('#signUpForm').submit(function (event) {
        event.preventDefault();
        if(loginCheck && passConfCheck) {
            $(this).ajaxSubmit({
                beforeSubmit: function () {
                    $('#signInModalLabel').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 p-0" id="signIcon"></i>');
                },
                success: function (data) {
                    $('#signIcon').remove();
                    if ($('#signUpForm').attr('action') === 'php/auth.php') {
                        if (data) {
                            document.location.replace('../profile.php');
                        } else {
                            $('#password').val('');
                            $('#password').attr('placeholder', 'Неверно!');
                            $('.modal input[id=password]').focus();
                            setTimeout(function () {
                                $('#password').attr('placeholder', 'Input your password here');
                            }, 2000);
                        }
                    } else {
                        document.location.replace('../index.php');
                    }
                },
            });
        }
        else{
            alert('Error!');
        }
    });

    //CHECK A LOGIN IN DB (TO AVOID A DUPLICATE LOGINS)
    $('#login').on('change', function () {
        if($('#signUpForm').attr('action') === 'php/reg.php') {
            $('.checkIcon').remove();
            let login = $(this).val();
            $.ajax({
                url: '../php/checkLogin.php',
                type: 'POST',
                data: 'login=' + login,
                success: function (check) {
                    if (check) {
                        loginCheck = true;
                        $('#login').before('<div class="checkIcon text-muted"><i class="fa fa-check text-muted" aria-hidden="true"></i></div>');
                    } else {
                        loginCheck = false;
                        $('#login').before('<div class="checkIcon text-muted"><span class="text-muted"><i class="fa fa-times" aria-hidden="true"></i>This login already exists!</span><div class="checkIcon"></div>');
                    }
                    $('.checkIcon').css('position', 'absolute');
                    $('.checkIcon').css('right', '2rem');
                    $('.checkIcon').css('top', '3.8rem');
                }
            });
        }
    });

    //FOR 'CATALOG' PAGE

    //SET PICKED SORTING OF PRODUCTS AND LOADS PRODUCTS
    if($('#catalog').hasClass('active')) {
        var sortBy = $('#sortProducts .dropdown-item input[type=radio]:first').val();

        loadProducts(sortBy, offsetProducts);

        $('#sortProducts .dropdown-item').click(function () {
            offsetProducts = 0;
            $('#sortProducts .dropdown-item').removeClass('active');
            $('#sortProducts .dropdown-item input[type=radio]').prop('checked', false);
            $(this).addClass('active');
            $(this).find('input').prop('checked', true);
            sortBy = $(this).find('input').val();
            $('#sortProducts .dropdown-toggle').html('Sorted by: ' + $(this).find('label').text());
            $('#productsContent').empty();
            loadProducts(sortBy, offsetProducts);
        });

        $('#loadProductsBtn').click(function () {
            offsetProducts += 4;
            loadProducts(sortBy, offsetProducts);
        });
    }

    //CALCULATES COUNT OF PRODUCTS IN USER'S CART AND LOADS USER'S CART IF USER'S IN 'PROFILE' PAGE
    $.ajax({
        url: '../php/countCart.php',
        beforeSend: function () {
            if(!$('#catalog').hasClass('active')) {
                $('#layer').css('top', $('#header').height());
                $('#layer').css('height', $('body').height()).fadeIn('fast');
                $('#mainContainer').before('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
                $('#loadIcon').css('position', 'absolute');
                $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
                $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2) + $(window).scrollTop());
                $('html').css('overflow', 'hidden');
            }
        },
        success: function (data) {
            if(!$('#catalog').hasClass('active')) {
                $('#loadIcon').remove();
                $('#layer').fadeOut('fast');
                $('html').css('overflow', 'visible');
            }
            $('#countCart').text(data.split(' ').length - 1);

            if($('#profile').hasClass('active')) {
                if($('#countCart').text() != 0) {
                    $.ajax({
                        url: '../php/loadCart.php',
                        beforeSend: function () {
                            if(!$('#catalog').hasClass('active')) {
                                $('#layer').css('top', $('#header').height());
                                $('#layer').css('height', $('body').height()).fadeIn('fast');
                                $('#mainContainer').before('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
                                $('#loadIcon').css('position', 'absolute');
                                $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
                                $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2) + $(window).scrollTop());
                                $('html').css('overflow', 'hidden');
                            }
                        },
                        success: function (data) {
                            if(!$('#catalog').hasClass('active')) {
                                $('#loadIcon').remove();
                                $('#layer').fadeOut('fast');
                                $('html').css('overflow', 'visible');
                            }
                            $('#divCart').css('visibility', 'visible');
                            $('#makeAnOrderBtn').before(data);
                            $('#makeAnOrderBtn').removeAttr('disabled');
                            $('.wish-price').each(function () {
                                summCart += parseInt($(this).text().replace(/[^0-9]/g, ''), 10);
                            });
                            $('#makeAnOrderBtn').before('<p id="summCart">Full price in your order is: '+summCart+' RUB</p>');
                        }
                    });
                }
                else {
                    $('#divCart').css('visibility', 'visible');
                    $('#makeAnOrderBtn').before('<ul class=\"list-unstyled\"><i class=\"fa fa-2x fa-shopping-basket m-0\" aria-hidden=\"true\"></i></ul>');
                    $('#makeAnOrderBtn').before('<p id="summCart">Full price in your order is: '+summCart+' RUB</p>');
                    $('#makeAnOrderBtn').attr('disabled', 'true');
                }
            }
        }
    });

    //SET HEIGHT OF CART IN 'PROFILE' PAGE
    $('#divCart').css('max-height', innerHeight-$('#header').height()*2-$('#footer').height()+'px');

});

//FUNCTION THAT CLEARS INPUTS ON AUTH FORM WHEN IT'S CLOSING
function clearInputs() {
    $("#login").val('');
    $("#login").attr('placeholder', 'Input your login here');
    $("#password").val('');
    $("#password").attr('placeholder', 'Input your password here');
    if($('#passwordConfirm').length) {
        $("#passwordConfirm").val('');
        $("#passwordConfirm").attr('placeholder', 'Confirm your password here');
        $('#firstName').val('');
        $("#firstName").attr('placeholder', 'Input your first here');
        $('#lastName').val('');
        $("#lastName").attr('placeholder', 'Input your last name here');
        $('#patronymic').val('');
        $("#patronymic").attr('placeholder', 'Input your patronymic here if you have that');
    }
}

//FUNCTION FOR EXIT FROM ACCOUNT
function signOut() {
    $.ajax('php/exit.php')
        .done(function () {
            document.location.replace("index.php");
        });
}

//FUNCTION THAT CHANGE INPUTS TO REGISTER OR LOG IN FORM
function toReg() {
    if(!$('#passwordConfirm').length) {
        clearInputs();
        loginCheck = true;
        passConfCheck = true;
        $('#signInModalLabel').text('Sign up');
        $('#login').attr('pattern', '[a-zA-Z]{5,}');
        $('#password').attr('pattern', '(?=^.{8,}$)((?=.*\\d)|(?=.*\\W+))(?![.\\n])(?=.*[A-Z])(?=.*[a-z]).*');
        $('#divPassword').append('<input type=\"password\" class=\"form-control mt-3 mb-3\" id=\"passwordConfirm\" name=\"passwordConfirm\" placeholder=\"Confirm your password here\">')
                        .after('<div class="form-group" id="divFirstName"></div>');
        $('#divFirstName').append("<label for=\"firstName\" class=\"col-form-label\">Your first name:</label>")
                        .append("<input type=\"text\" class=\"form-control\" id=\"firstName\" name=\"firstName\" pattern=\"[a-zA-Z]{3,}\" placeholder=\"Input your first name here\">")
                        .after('<div class="form-group" id="divLastName"></div>');
        $('#divLastName').append("<label for=\"lastName\" class=\"col-form-label\">Your last name:</label>")
                        .append("<input type=\"text\" class=\"form-control\" id=\"lastName\" name=\"lastName\" pattern=\"[a-zA-Z]{3,}\" placeholder=\"Input your last name here\">")
                        .after('<div class="form-group" id="divPatronymic"></div>');
        $('#divPatronymic').append("<label for=\"patronymic\" class=\"col-form-label\">Your patronymic:</label>")
            .append("<input type=\"text\" class=\"form-control\" id=\"patronymic\" name=\"patronymic\" pattern=\"[a-zA-Z]{3,}\" placeholder=\"Input your patronymic here if you have that\">");
        $('#signUpForm').attr('action', 'php/reg.php');
        $('#signInUpBtn').val("Sign up");
        $('#labelRegLog').text('Already have an account?');
        $('#passwordConfirm').change(function () {
            $('.checkIconPass').remove();
            if($(this).val() == $('#password').val()) {
                passConfCheck = true;
                $('#passwordConfirm').before('<div class="checkIconPass text-muted"><i class="fa fa-check text-muted" aria-hidden="true"></i></div>');
            }
            else {
                passConfCheck = false;
                $('#login').before('<div class="checkIconPass text-muted"><span class="text-muted"><i class="fa fa-times" aria-hidden="true"></i>Passwords mismatch!</span><div class="checkIcon"></div>');
            }
            $('.checkIconPass').css('position', 'absolute');
            $('.checkIconPass').css('right', '2rem');
            $('.checkIconPass').css('top', '13rem');
        });
    }
    else {
        clearInputs();
        $('#passwordConfirm').remove();
        $('#divFirstName').remove();
        $('#divLastName').remove();
        $('#divPatronymic').remove();
        $('#password').attr('pattern', '*+');
        $('#signUpForm').attr('action', 'php/auth.php');
        $('#signInModalLabel').text('Sign in');
        $('#signInUpBtn').val('Sign in');
        $('#labelRegLog').text('Haven\'t an account?');
    }
    $('.modal input[type=text]:first').focus();
}

//FUNCTION THAT LET REMOVE USER FROM DB
function removeUser(idUser) {
    let rly = confirm("Are you sure you want delete this row?");
    if(rly) {
        $.ajax({
            url: '../php/removeUser.php',
            type: 'POST',
            data: 'idUser='+idUser,
            beforeSend: function () {
                $('#usersEditModalTitle').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="signIcon"></i>');
            },
            success: function (data) {
                $('#signIcon').remove();
                if(data) $("#row"+idUser).remove();
                else {
                    $('#usersEditModalTitle').text('Error!');
                    setTimeout(function () {
                        $('#usersEditModalTitle').text('Users table');
                    }, 2000);
                }
            }
        });
    }
}

//FUNCTION THAT LET EDIT USER INFORMATION IN DB
function editUser(idUser) {
    $('<tr id="row'+idUser+'"><form method="post" action="../php/editUser.php" id="editUsersForm">'+
        '<td class="bg-light"><input type="text" name="editID" value="'+idUser+'" readonly form="editUsersForm" size="1"></td>'+
        '<td><input type="text" name="editLogin" form="editUsersForm" size="4"></td>'+
        '<td class="bg-light"></td>'+
        '<td><input type="text" name="editFirstName" form="editUsersForm" size="4"></td>'+
        '<td><input type="text" name="editLastName" form="editUsersForm" size="4"></td>'+
        '<td><input type="text" name="editPatronymic" form="editUsersForm" size="4"></td>'+
        '<td><input type="text" name="editPicture" form="editUsersForm" size="4"></td>'+
        '<td><input type="text" name="editStatus" form="editUsersForm" size="4"></td>'+
        '<td class="bg-light"></td>'+
        '<td><input type="submit" form="editUsersForm" class="btn btn-sm btn-outline-secondary" id="saveUserBtn" value="Save changes"></td>'+
        '</form></tr>').replaceAll('#row'+idUser);

    $('#editUsersForm').submit(function (event) {
        event.preventDefault();
        $(this).ajaxSubmit({
            beforeSubmit: function () {
                $('#usersEditModalTitle').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="signIcon"></i>');
            },
            success: function (data) {
                $('#signIcon').remove();
                if(data) {
                    $('#usersTableDiv').load('../php/loadUsersTable.php');
                }
                else {
                    alert('Error!');
                    $('#usersTableDiv').load('../php/loadUsersTable.php');
                }
            }
        })
    })
}

//FUNCTION THAT LET REMOVE FABRICATOR FROM DB
function removeFabricator(idFabricator) {
    let rly = confirm("Are you sure you want delete this row?");
    if(rly) {
        $.ajax({
            url: '../php/removeFabricator.php',
            type: 'POST',
            data: 'idFabricator='+idFabricator,
            beforeSend: function () {
                $('#fabricatorsEditModalTitle').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="signIcon"></i>');
            },
            success: function (data) {
                $('#signIcon').remove();
                if(data) $("#row"+idFabricator).remove();
                else {
                    $('#fabricatorsEditModalTitle').text('Error!');
                    setTimeout(function () {
                        $('#fabricatorsEditModalTitle').text('Fabricators table');
                    }, 2000);
                }
            }
        });
    }
}

//FUNCTION THAT LET EDIT FABRICATOR INFORMATION IN DB
function editFabricator(idFabricator) {
    $('<tr id="row'+idFabricator+'"><form method="post" action="../php/editFabricator.php" id="editFabricatorsForm">'+
        '<td class="bg-light"><input type="text" name="editID" value="'+idFabricator+'" readonly form="editFabricatorsForm" size="1"></td>'+
        '<td><input type="text" name="editName" form="editFabricatorsForm" size="4"></td>'+
        '<td><input type="text" name="editBoss" form="editFabricatorsForm" size="4"></td>'+
        '<td><input type="submit" form="editFabricatorsForm" class="btn btn-sm btn-outline-secondary" id="saveFabricatorsBtn" value="Save changes"></td>'+
        '</form></tr>').replaceAll('#row'+idFabricator);

    $('#editFabricatorsForm').submit(function (event) {
        event.preventDefault();
        $(this).ajaxSubmit({
            beforeSubmit: function () {
                $('#fabricatorsEditModalTitle').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="signIcon"></i>');
            },
            success: function (data) {
                $('#signIcon').remove();
                if(data) {
                    $('#fabricatorsTableDiv').load('../php/loadFabricatorsTable.php');
                }
                else {
                    alert('Error!');
                    $('#fabricatorsTableDiv').load('../php/loadFabricatorsTable.php');
                }
            }
        })
    })
}

//FUNCTION THAT LOADS LIST OF PRODUCTS ON PAGE 'CATALOG'
function loadProducts(sort, offProd) {
    $.ajax({
        url: '../php/loadProducts.php',
        type: 'POST',
        data: {sortBy: sort, offsetProducts: offProd},
        beforeSend: function () {
            $('#layer').css('top', $('#header').height());
            $('#layer').css('height', $('body').height()).fadeIn('fast');
            $('#sortProducts').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
            $('#loadIcon').css('position','absolute');
            $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
            $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2 ) + $(window).scrollTop());
            $('html').css('overflow', 'hidden');
        },
        success: function (data) {
            $('#loadIcon').remove();
            $('#layer').fadeOut('fast');
            $('html').css('overflow', 'visible');
            if (data) {
                $('#productsContent').append(data);
            } else {
                alert('Error!');
            }
        }
    });
}

//FUNCTION THAT LET EDIT PRODUCT INFORMATION IN DB
function editProduct(idProduct) {

    $('#category'+idProduct).before('<form method="post" action="../php/editProduct.php" id="editProductForm">');
    $('#category'+idProduct).before('<input type="text" name="editID" form="editProductForm" size="1" hidden  value="'+idProduct+'">');
    $('<div class="card-footer d-flex justify-content-center" id="cardFooter'+idProduct+'">'+
        '<input type="submit" form="editProductForm" class=\"btn btn-sm btn-outline-secondary w-50\" id="saveProductBtn" value="Save changes">'+
        '</div>').replaceAll('#cardFooter'+idProduct);
    $('#category'+idProduct).before('<p id="editPicRow">Picture: <input type="text" name="editPicture" form="editProductForm" size="4" style="margin-bottom: 1rem;"></p>');
    $('#price'+idProduct).html('<p id="editPriceRow">Price: <input type="text" name="editPrice" form="editProductForm" size="4"> RUB</p>');
    $('#sizes'+idProduct).html('<p id="editSizesRow">Sizes: <input type="text" name="editSizes" form="editProductForm" size="4"></p><p id="hiddenSizes" style="visibility: hidden">' + $('#sizes'+idProduct).text() + '</p>');


    $('#editProductForm').submit(function (event) {
        event.preventDefault();
        $(this).ajaxSubmit({
            beforeSubmit: function () {
                $('#layer').css('top', $('#header').height());
                $('#layer').css('height', $('body').height()).fadeIn('fast');
                $('#sortProducts').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
                $('#loadIcon').css('position','absolute');
                $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
                $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2 ) + $(window).scrollTop());
                $('html').css('overflow', 'hidden');
            },
            success: function (data) {
                $('#loadIcon').remove();
                $('#layer').fadeOut('fast');
                $('html').css('overflow', 'visible');
                if(data) {
                    if($('input[name=editPicture]').val()) $('#picture'+idProduct).prop('src', '../pictures/products/'+$('input[name=editPicture]').val());
                    $('#editPicRow').remove();
                    if($('input[name=editPrice]').val()) $('#price'+idProduct).text('Price: ' + $('input[name=editPrice]').val() + ' RUB');
                    $('input[name=editPrice]').remove();
                    if($('input[name=editSizes]').val()) $('#sizes'+idProduct).text('Sizes: ' + $('input[name=editSizes]').val());
                    else {
                        $('#sizes'+idProduct).text($('#hiddenSizes').text());
                        $('#hiddenSizes').remove();
                    }
                    $('#editSizesRow').remove();
                    $('#editProductForm').remove();
                    $('<div class="card-footer d-flex justify-content-between" id="cardFooter'+idProduct+'">'+
                        '<button class="btn btn-sm btn-outline-secondary w-50">Add to cart</button>'+
                        '<button class="btn btn-sm btn-outline-secondary w-50" onclick="editProduct('+idProduct+');">Edit</button>'+
                        '<button class="btn btn-sm btn-outline-secondary w-50" onclick="removeProduct('+idProduct+');">Remove</button>'+
                        '</div></div>').replaceAll($('#cardFooter'+idProduct));
                }
                else {
                    alert('Error!');
                }
            }
        })
    })
}

//FUNCTION THAT LET EDIT PRODUCT INFORMATION IN DB
function removeProduct(idProduct) {
    let rly = confirm("Are you sure you want delete this product?");
    if(rly) {
        $.ajax({
            url: '../php/removeProduct.php',
            type: 'POST',
            data: 'idProduct='+idProduct,
            beforeSend: function () {
                $('#layer').css('top', $('#header').height());
                $('#layer').css('height', $('body').height()).fadeIn('fast');
                $('#sortProducts').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
                $('#loadIcon').css('position','absolute');
                $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
                $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2 ) + $(window).scrollTop());
                $('html').css('overflow', 'hidden');
            },
            success: function (data) {
                $('#loadIcon').remove();
                $('#layer').fadeOut('fast');
                $('html').css('overflow', 'visible');
                if(data) $("#"+idProduct).remove();
                else {
                    alert("Error!");
                }
            }
        });
    }
}

//FUNCTION THAT LET ADD PICKED PRODUCT IN USER'S CART
function addToCart(idProduct) {
    if(getCookie('login')) {
        $.ajax({
            url: '../php/addToCart.php',
            type: 'POST',
            data: 'idProduct=' + idProduct,
            beforeSend: function () {
                $('#layer').css('top', $('#header').height());
                $('#layer').css('height', $('body').height()).fadeIn('fast');
                $('#sortProducts').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
                $('#loadIcon').css('position', 'absolute');
                $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
                $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2) + $(window).scrollTop());
                $('html').css('overflow', 'hidden');
            },
            success: function (data) {
                $('#loadIcon').remove();
                $('#layer').fadeOut('fast');
                $('html').css('overflow', 'visible');
                if (data) {
                    $('#countCart').text(function(i, txt) {
                        return (parseInt(txt, 10)+1);
                    });
                }
                else {
                    alert("Error!");
                }
            }
        });
    }
    else {
        $('#signInBtn').click();
    }
}

//FUNCTION THAT LET REMOVE PICKED PRODUCT FROM USER'S CART
function deleteFromCart(idProduct) {
    let rly = confirm("Are you sure you want delete this product?");
    if(rly) {
        $.ajax({
            url: '../php/deleteFromCart.php',
            type: 'POST',
            data: 'idProduct='+idProduct,
            beforeSend: function () {
                $('#layer').css('top', $('#header').height());
                $('#layer').css('height', $('body').height()).fadeIn('fast');
                $('#mainContainer').before('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
                $('#loadIcon').css('position','absolute');
                $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
                $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2 ) + $(window).scrollTop());
                $('html').css('overflow', 'hidden');
            },
            success: function (data) {
                $('#loadIcon').remove();
                $('#layer').fadeOut('fast');
                $('html').css('overflow', 'visible');
                if(data) {
                    $("#wish"+idProduct).remove();
                    summCart = 0;
                    $('.wish-price').each(function () {
                        summCart += parseInt($(this).text().replace(/[^0-9]/g, ''), 10);
                    });
                    $('#summCart').text('Full price in your order is: '+summCart+' RUB');
                    $('#countCart').text(function(i, txt) {
                        return (parseInt(txt, 10)-1);
                    });
                    if($('#countCart').text()==0) $('#makeAnOrderBtn').attr('disabled', 'true');
                }
                else {
                    alert("Error!");
                }
            }
        });
    }
}

function makeAnOrder() {
    $.ajax({
        url: '../php/makeAnOrder.php',
        type: 'POST',
        data: 'price='+summCart,
        beforeSend: function () {
            $('#layer').css('top', $('#header').height());
            $('#layer').css('height', $('body').height()).fadeIn('fast');
            $('#mainContainer').before('<i class="fa fa-spinner fa-pulse fa-2x fa-fw m-0 ml-3 p-0" id="loadIcon"></i>');
            $('#loadIcon').css('position','absolute');
            $('#loadIcon').css('left', $(window).width() / 2 - $('#loadIcon').width() / 2);
            $('#loadIcon').css('top', ($(window).height() / 2 - $('#loadIcon').height() / 2 ) + $(window).scrollTop());
            $('html').css('overflow', 'hidden');
        },
        success: function (data) {
            $('#loadIcon').remove();
            $('#layer').fadeOut('fast');
            $('html').css('overflow', 'visible');
            if(data) {
                alert("Your order is processed!");
            }
            else {
                alert("Error!");
            }
        }
    })
}

function addProduct() {
    let nameProd = $('#nameProd').val();
    let pictureProd = $('#pictureProd').val();
    let categoryProd = $('#categoryProd').val();
    let priceProd = $('#priceProd').val();
    let sizesProd = $('#sizesProd').val();
    let fabricatorProd = $('#fabricatorProd').val();
    $.ajax({
        url: 'php/addProduct.php',
        type: 'POST',
        data: {
            nameProd: nameProd,
            pictureProd: pictureProd,
            categoryProd: categoryProd,
            priceProd: priceProd,
            sizesProd: sizesProd,
            fabricatorProd: fabricatorProd
        },
        beforeSend: function () {

        },
        success: function (data) {
            if(data) {
                alert('Done!');
                $('input').each(function () {
                    $(this).val('');
                })
            }
            else alert('Error!');
        }
    })
}