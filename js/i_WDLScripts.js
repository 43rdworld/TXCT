// JavaScript Document

//====================================================================================================================================================
//= ONLOAD FUNCTION FOR USE WHEN COMING TO OR RETURNING TO A PAGE WITH DATA
//====================================================================================================================================================
//- FUNCTION TO TAKE A CREDIT CARD INITIAL FROM SESSION AND MOVE THE CREDIT CAR GRAPHIC SO THAT THE CORRECT IMAGE SHOWS ------------------------------
    function setCCType(ccType) {
        if(ccType != '') {
            if(ccType == 'v') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -23px';
            } else if (ccType == 'm') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -46px';
            } else if (ccType == 'a') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -69px';
            } else if (ccType == 'd') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -92px';
            }
        }
    }

//-	FUNCTION COPIES THE GENERATED FORM SECRERT (USED TO CHECK FOR DUPLICATE SUBMISSIONS) AND COPIES IT TO A HIDDEN FORM FIELD ------------------------
    function copyFormSecret(ip) {
        document.getElementById('formSecret').value = ip;
    }

//-	FUNCTION FOCUSES FORM ON THE FIELD THAT IS PASSED INTO THE FUNCTION -------------------------------------------------------------------------------
    function focusIt(theID) {
        document.getElementById(theID).focus();
    }


    var presentingSponsorCopy = '' +
        '<div class="tooltipster-wdl_Head">Presenting Sponsor ($50,000)&#160;&#160;&mdash;&#160;&#160;<span class="wdlSponsorshipSold">SOLD</span></div>'+
//        '<div class="tooltipster-wdl_SubHead">Presenting Sponsor Promotional Rights and Event Recognition</div>'+
        '<ul class="tooltipster-wdl_UL">' +
            '<li>Exceptional Seating for 20 Guests</li>' +
            '<li>Highly visible presenting sponsor recognition signage at luncheon</li>' +
            '<li>Special presenting sponsor recognition during the Luncheon</li>' +
            '<li>Recognition in invitation, program, e-newsletter, and other collateral</li>' +
            '<li>Company logo on all printed material and website</li>' +
            '<li>Logo recognition in sponsor presentation</li>' +
            '<li>Invitations for 20 to Pre-Luncheon Speaker Reception</li>' +
            '<li>Invitations for 10 to VIP Reception</li>' +
        '</ul>';

    var speakerSponsorCopy = '' +
        '<div class="tooltipster-wdl_Head">Speaker Sponsor ($25,000)</div>'+
//        '<div class="tooltipster-wdl_SubHead">Speaker Sponsor Promotional Rights and Event Recognition</div>'+
        '<ul class="tooltipster-wdl_UL">' +
            '<li>Exceptional Seating for 20 Guests</li>' +
            '<li>Recognition announcement during the Luncheon</li>' +
            '<li>Recognition in invitation, program, e-newsletter, and other collateral</li>' +
            '<li>Company logo on all printed material and website</li>' +
            '<li>Logo recognition in sponsor presentation</li>' +
            '<li>Invitations for 20 to Pre-Luncheon Speaker Reception</li>' +
            '<li>Invitations for 10 to VIP Reception</li>' +
        '</ul>';

    var platinumSponsorCopy = '' +
        '<div class="tooltipster-wdl_Head">Platinum Sponsor ($15,000)</div>'+
//        '<div class="tooltipster-wdl_SubHead">Platinum Sponsor Promotional Rights and Event Recognition</div>'+
        '<ul class="tooltipster-wdl_UL">' +
            '<li>Wonderful Seating for 10 Guests</li>' +
            '<li>Recognition announcement during the Luncheon</li>' +
            '<li>Recognition in invitation, program, e-newsletter, and other collateral</li>' +
            '<li>Company logo on all printed material and website</li>' +
            '<li>Logo recognition in sponsor presentation</li>' +
            '<li>Invitations for 10 to Pre-Luncheon Speaker Reception</li>' +
            '<li>Invitations for 10 to VIP Reception</li>' +
        '</ul>';

    var goldSponsorCopy = '' +
        '<div class="tooltipster-wdl_Head">Gold Sponsor ($10,000)</div>'+
//        '<div class="tooltipster-wdl_SubHead">Gold Sponsor Promotional Rights and Event Recognition</div>'+
        '<ul class="tooltipster-wdl_UL">' +
            '<li>Excellent Seating for 10 Guests</li>' +
            '<li>Recognition in invitation, program, e-newsletter, and other collateral</li>' +
            '<li>Company logo on all printed material and website</li>' +
            '<li>Logo recognition in sponsor presentation</li>' +
            '<li>Invitations for 6 to Pre-Luncheon Speaker Reception</li>' +
            '<li>Invitations for 6 to VIP Reception</li>' +
        '</ul>';

    var silverSponsorCopy = '' +
        '<div class="tooltipster-wdl_Head">Silver Sponsor ($5,000)</div>'+
//        '<div class="tooltipster-wdl_SubHead">Silver Sponsor Promotional Rights and Event Recognition</div>'+
        '<ul class="tooltipster-wdl_UL">' +
            '<li>Superior Seating for 10 Guests</li>' +
            '<li>Recognition in program and other collateral</li>' +
            '<li>Company logo on website</li>' +
            '<li>Logo recognition in sponsor presentation</li>' +
            '<li>Invitations for 4 to Pre-Luncheon Speaker Reception</li>' +
            '<li>Invitations for 4 to VIP Reception</li>' +
        '</ul>';

    var bronzeSponsorCopy = '' +
        '<div class="tooltipster-wdl_Head">Bronze Sponsor ($2,500)</div>'+
//        '<div class="tooltipster-wdl_SubHead">Bronze Sponsor Promotional Rights and Event Recognition</div>'+
        '<ul class="tooltipster-wdl_UL">' +
            '<li>Seating for 10 Guests</li>' +
            '<li>Recognition in program and other collateral</li>' +
            '<li>Recognition in sponsor presentation</li>' +
            '<li>Invitations for 2 to Pre-Luncheon Speaker Reception</li>' +
            '<li>Invitations for 2 to VIP Reception</li>' +
        '</ul>' +
        '<div class="tooltipster-wdl_Divider">&#32;</div>' +
        '<div class="tooltipster-wdl_Copy">* There are a limited number of $2,500 tables</div>';



    $(document).ready(function(){

// LOAD PAGE OPTIONS BASED ON SAVED SESSION VALUES ---------------------------------------------------------------------------------------------------
//* TICKET *******************************************************************************************************************************************
        if($('#registrationType').val() == 'ticket') {
            $('#eventIntroCopy').hide();
            $('#selectTicket').attr("checked","checked");
            $('#ticketIntroCopy').slideDown("slow","easeOutBounce");
            $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
            $('#ticketSelect_Wrapper').slideDown("slow","easeOutBounce");
//            $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
            $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
            $('#submitForm').show();
            $('#contactAddressWrapper').show();
            $('#contactFaxWrapper').show();
//* TABLE ********************************************************************************************************************************************
        } else if($('#registrationType').val() == 'table') {
            $('#eventIntroCopy').hide();
            $('#selectTable').attr("checked","checked");
            $('#tableIntroCopy').slideDown("slow","easeOutBounce");
            $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
            $('#tableSelect_Wrapper').slideDown("slow","easeOutBounce");
//            $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
            $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
            $('#submitForm').show();
            $('#contactAddressWrapper').show();
            $('#contactFaxWrapper').show();
//* SPONSOR ******************************************************************************************************************************************
        } else if($('#registrationType').val() == 'sponsor') {
            $('#eventIntroCopy').hide();
            $('#selectSponsor').attr("checked","checked");
            $('#sponsorIntroCopy').slideDown("slow","easeOutBounce");
            $('#sponsorSelect_Wrapper').slideDown("slow","easeOutBounce");
            $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
            $('#contactAddressWrapper').hide();
            $('#contactFaxWrapper').hide();
            if(($('#sponsorLevelTemp').val() == 'silver') || ($('#sponsorLevelTemp').val() == 'bronze')) {
                $('#contactAddressWrapper').slideDown(300);
                $('#contactFaxWrapper').slideDown(300);
                $('#contactForm').hide();
                $('#submitForm').fadeIn("slow");
            }
//* DONATE *******************************************************************************************************************************************
        } else if($('#registrationType').val() == 'donate') {
            $('#eventIntroCopy').hide();
            $('#selectDonate').attr("checked","checked");
            $('#contactAddressWrapper').show();
            $('#contactFaxWrapper').show();
            $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
            $('#donate_Wrapper').slideDown("slow","easeOutBounce");
//            $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
            $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
            $('#submitForm').show();
//* RAFFLE *******************************************************************************************************************************************
//        } else if($('#registrationType').val() == 'raffle') {
//            $('#eventIntroCopy').hide();
//            $('#selectRaffle').attr("checked","checked");
//            $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
////            $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
//            $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
//            $('#submitContact').show();
//            $('#contactAddressWrapper').show();
//            $('#contactFaxWrapper').show();
        }




        $('#tblNumTables').change(function() {
            $('#tblMoreTables').removeAttr("checked");
            $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
        });

        $('#tblMoreTables').click(function() {
            if( $('#tblMoreTables').is(':checked')) {
                $('#tblNumTables').prop('selectedIndex', 0);
                $('#tblNumTables').attr('class', 'form_Select250 normal');
                $('#tblHostAmountTemp').val('');
                $('#tributeGift_Wrapper').slideUp("slow","easeOutBounce");
                $('#submitForm').hide();
                $('#submitContact').fadeIn("slow");
            } else {
                $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
                $('#submitContact').hide();
                $('#submitForm').fadeIn("slow");
            }
        });



        $('input[name=selectEvent]').click(function() {
//= TICKETS ==========================================================================================================================================
            if($(this).val() == 'ticket') {
            // ENABLE SUBMIT BUTTON FOR PAYMENTS, HIDE BUTTON FOR CONTACTS ---------------------------------------------------------------------------
                $('#submitForm').fadeIn("slow");
                $('#submitContact').hide();
            // OPEN TICKET WRAPPERS ------------------------------------------------------------------------------------------------------------------
                $('#registrationType').val('ticket');
                $('#ticketIntroCopy').slideDown("slow","easeOutBounce");
                $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
                $('#ticketSelect_Wrapper').slideDown("slow","easeOutBounce");
//                $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
                $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
                $('#contactAddressWrapper').show();
                $('#contactFaxWrapper').show();
            // CLOSE OTHER WRAPPERS
                $('#eventIntroCopy').slideUp("slow","easeOutBounce");
                $('#tableIntroCopy').slideUp("slow","easeOutBounce");
                $('#sponsorIntro').slideUp("slow","easeOutBounce");
                $('#sponsorIntroCopy').slideUp("slow","easeOutBounce");
                $('#donateIntro').slideUp("slow","easeOutBounce");
//                $('#raffleIntro').slideUp("slow","easeOutBounce");
                $('#tableSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#sponsorSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#sponsorContact_Wrapper').slideUp("slow","easeOutBounce");
                $('#donate_Wrapper').slideUp("slow","easeOutBounce");
             // CLEAR OTHER VALUES --------------------------------------------------------------------------------------------------------------------
                // TABLES ----------------------------------------------------------------------------------------------------------------------------
                    $('#tblNumTables').prop('selectedIndex',0);
                    $('#tblNumTables').attr('class','form_Select250 normal');
                    $('#tblMoreTables').removeAttr("checked");
                    $('#tblHostAmountTemp').val('');
                // SPONSORSHIP LEVELS ----------------------------------------------------------------------------------------------------------------
                    $('#unsureSponsor').removeAttr("checked");
                    $('#speakerSponsor').removeAttr("checked");
                    $('#platinumSponsor').removeAttr("checked");
                    $('#goldSponsor').removeAttr("checked");
                    $('#silverSponsor').removeAttr("checked");
                    $('#bronzeSponsor').removeAttr("checked");
                    $('#sponsorLevelTemp').val('');
                // DONATIONS -------------------------------------------------------------------------------------------------------------------------
                    $('#donateAmt').val('');
                    $(':input[name="donateAck"]').val('');
                    $('#donateAnon').removeAttr("checked");
                // RAFFLE TICKETS AND TRIBUTES OK AS THEY ARE SHARED ---------------------------------------------------------------------------------
//                    $('#raffleTickets').val('');
//                    $('#raffleTickets').attr('class','form_Field50 normal');
//                    $('#raffleTicketsError').empty();
            }
//= TABLES ===========================================================================================================================================
            if($(this).val() == 'table') {
            // ENABLE SUBMIT BUTTON FOR PAYMENTS, HIDE BUTTON FOR CONTACTS ---------------------------------------------------------------------------
                $('#registrationType').val('table');
                $('#submitForm').fadeIn("slow");
                $('#submitContact').hide();
            // OPEN TABLE FORM WRAPPERS --------------------------------------------------------------------------------------------------------------
                $('#tableIntroCopy').slideDown("slow","easeOutBounce");
                $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
                $('#tableSelect_Wrapper').slideDown("slow","easeOutBounce");
//                $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
                $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
                $('#contactAddressWrapper').show();
                $('#contactFaxWrapper').show();
            // CLOSE OTHER WRAPPERS
                $('#eventIntroCopy').slideUp("slow","easeOutBounce");
                $('#ticketIntroCopy').slideUp("slow","easeOutBounce");
                $('#sponsorIntroCopy').slideUp("slow","easeOutBounce");
                $('#donateIntroCopy').slideUp("slow","easeOutBounce");
//                $('#raffleIntroCopy').slideUp("slow","easeOutBounce");
                $('#ticketSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#sponsorSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#sponsorContact_Wrapper').slideUp("slow","easeOutBounce");
                $('#donate_Wrapper').slideUp("slow","easeOutBounce");
            // CLEAR OTHER VALUES --------------------------------------------------------------------------------------------------------------------
//                    $('#raffleTickets').val('');
//                    $('#tktTickets').prop('selectedIndex',0);
//                    $('#tktTickets').attr('class','form_Select200 normal');
                // SPONSORSHIP LEVELS ----------------------------------------------------------------------------------------------------------------
                    $('#unsureSponsor').removeAttr("checked");
                    $('#speakerSponsor').removeAttr("checked");
                    $('#platinumSponsor').removeAttr("checked");
                    $('#goldSponsor').removeAttr("checked");
                    $('#silverSponsor').removeAttr("checked");
                    $('#bronzeSponsor').removeAttr("checked");
                // DONATIONS -------------------------------------------------------------------------------------------------------------------------
                    $('#donateAmt').val('');
                    $(':input[name="donateAck"]').val('');
                    $('#donateAnon').removeAttr("checked");
//                // RAFFLE TICKETS AND TRIBUTES OK AS THEY ARE SHARED ---------------------------------------------------------------------------------
//                    $('#raffleTickets').attr('class','form_Field50 normal');
//                    $('#raffleTicketsError').empty();

            }
//= SPONSORSHIP ======================================================================================================================================
            if($(this).val() == 'sponsor') {
            // ENABLE SUBMIT BUTTON FOR CONTACTS, HIDE BUTTON FOR PAYMENTS ---------------------------------------------------------------------------
                $('#registrationType').val('sponsor');
            // OPEN SPONSOR FORM WRAPPERS -----------------------------------------------------------------------------------------------------------
                $('#sponsorSelect_Wrapper').slideDown("slow","easeOutBounce");
                $('#sponsorIntroCopy').slideDown("slow","easeOutBounce");
                $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
//            // OPEN SUBMIT BUTTON DEPENDING WHICH SPONSOR LEVEL HAS BEEN SELECTED
//                if($('#sponsorLevelTemp').val() == '') {
//                    $('#submitContact').hide();
//                    $('#submitForm').hide();
//                }
                // CLOSE OTHER WRAPPERS
//                $('#levelsIntro').slideUp("slow","easeOutBounce");
                $('#eventIntroCopy').slideUp("slow","easeOutBounce");
                $('#ticketIntroCopy').slideUp("slow","easeOutBounce");
                $('#tableIntroCopy').slideUp("slow","easeOutBounce");
                $('#donateIntroCopy').slideUp("slow","easeOutBounce");
//                $('#raffleIntroCopy').slideUp("slow","easeOutBounce");
                $('#ticketSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#tableSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#raffleTickets_Wrapper').slideUp("slow","easeOutBounce");
                $('#tributeGift_Wrapper').slideUp("slow","easeOutBounce");
                $('#donate_Wrapper').slideUp("slow","easeOutBounce");
                $('#contactAddressWrapper').hide();
                $('#contactFaxWrapper').hide();
            // CLEAR OTHER VALUES
                // LUNCHEON TICKETS
                    $('#tktTickets').prop('selectedIndex',0)
                    $('#tktTickets').attr('class','form_Select200 normal');
                // TABLES ----------------------------------------------------------------------------------------------------------------------------
                    $('#tblNumTables').prop('selectedIndex',0);
                    $('#tblNumTables').attr('class','form_Select250 normal');
                    $('#tblMoreTables').removeAttr("checked");
                    $('#tblHostAmountTemp').val('');
                // RAFFLE TICKETS --------------------------------------------------------------------------------------------------------------------
//                    $('#raffleTickets').val('');
//                    $('#raffleTickets').attr('class','form_Field50 normal');
//                    $('#raffleTicketsError').empty();
                // TRIBUTES --------------------------------------------------------------------------------------------------------------------------
                    $('#tribute1').val('');
                    $('#tribute2').val('');
                    $('#tribute3').val('');
                    $('#tribute4').val('');
                // DONATIONS -------------------------------------------------------------------------------------------------------------------------
                    $('#donateAmt').val('');
                    $(':input[name="donateAck"]').val('');
                    $('#donateAnon').removeAttr("checked");
            }
//= DONATE ===========================================================================================================================================
            if($(this).val() == 'donate') {
            // ENABLE SUBMIT BUTTON FOR PAYMENTS, HIDE BUTTON FOR CONTACTS ---------------------------------------------------------------------------
                $('#registrationType').val('donate');
                $('#submitForm').fadeIn("slow");
                $('#submitContact').hide();
            // OPEN DONATION FORM WRAPPERS -----------------------------------------------------------------------------------------------------------
                $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
                $('#donate_Wrapper').slideDown("slow","easeOutBounce");
//                $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
                $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
                $('#contactAddressWrapper').show();
                $('#contactFaxWrapper').show();
            // CLOSE OTHER WRAPPERS ------------------------------------------------------------------------------------------------------------------
//                $('#levelsIntro').slideUp("slow","easeOutBounce");
                $('#eventIntroCopy').slideUp("slow","easeOutBounce");
                $('#ticketIntroCopy').slideUp("slow","easeOutBounce");
                $('#tableIntroCopy').slideUp("slow","easeOutBounce");
                $('#sponsorIntroCopy').slideUp("slow","easeOutBounce");
                $('#donateIntroCopy').slideUp("slow","easeOutBounce");
//                $('#raffleIntroCopy').slideUp("slow","easeOutBounce");
                $('#sponsorSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#sponsorContact_Wrapper').slideUp("slow","easeOutBounce");
                $('#ticketSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#tableSelect_Wrapper').slideUp("slow","easeOutBounce");
                $('#donation_Wrapper').slideUp("slow","easeOutBounce");
            // CLEAR OTHER VALUES
                // LUNCHEON TICKETS
                    $('#tktTickets').prop('selectedIndex',0)
                    $('#tktTickets').attr('class','form_Select200 normal');
                // TABLES
                    $('#tblNumTables').prop('selectedIndex',0);
                    $('#tblNumTables').attr('class','form_Select250 normal');
                    $('#tblMoreTables').removeAttr("checked");
                    $('#tblHostAmountTemp').val('');
                // SPONSORSHIP LEVELS
                    $('#speakerSponsor').removeAttr("checked");
                    $('#platinumSponsor').removeAttr("checked");
                    $('#goldSponsor').removeAttr("checked");
                    $('#silverSponsor').removeAttr("checked");
                    $('#bronzeSponsor').removeAttr("checked");
                // SPONSORSHIP CONTACT ---------------------------------------------------------------------------------------------------------------
                // DONATIONS -------------------------------------------------------------------------------------------------------------------------
                // RAFFLE TICKETS --------------------------------------------------------------------------------------------------------------------
//                    $('#raffleTickets').val('');
//                    $('#raffleTickets').attr('class','form_Field50 normal');
//                    $('#raffleTicketsError').empty();
            }
//            if($(this).val() == 'raffle') {
//                $('#registrationType').val('raffle');
//                $('#submitForm').fadeIn("slow");
//                $('#submitContact').hide();
//                $('#raffleIntroCopy').slideDown("slow","easeOutBounce");
//                $('#contactInfo_Wrapper').slideDown("slow","easeOutBounce");
//                $('#raffleTickets_Wrapper').slideDown("slow","easeOutBounce");
//                $('#tributeGift_Wrapper').slideDown("slow","easeOutBounce");
//                $('#contactAddressWrapper').show();
//                $('#contactFaxWrapper').show();
//            // CLOSE OTHER WRAPPERS
//                $('#eventIntroCopy').slideUp("slow","easeOutBounce");
//                $('#ticketIntroCopy').slideUp("slow","easeOutBounce");
//                $('#tableIntroCopy').slideUp("slow","easeOutBounce");
//                $('#sponsorIntroCopy').slideUp("slow","easeOutBounce");
//                $('#donateIntroCopy').slideUp("slow","easeOutBounce");
//                $('#donate_Wrapper').slideUp("slow","easeOutBounce");
//                $('#sponsorSelect_Wrapper').slideUp("slow","easeOutBounce");
//                $('#sponsorContact_Wrapper').slideUp("slow","easeOutBounce");
//                $('#ticketSelect_Wrapper').slideUp("slow","easeOutBounce");
//                $('#tableSelect_Wrapper').slideUp("slow","easeOutBounce");
//                $('#donation_Wrapper').slideUp("slow","easeOutBounce");
//            // CLEAR OTHER VALUES
//                // LUNCHEON TICKETS
//                    $('#tktTickets').prop('selectedIndex',0)
//                    $('#tktTickets').attr('class','form_Select200 normal');
//                // TABLES
//                    $('#tblNumTables').prop('selectedIndex',0);
//                    $('#tblNumTables').attr('class','form_Select250 normal');
//                    $('#tblMoreTables').removeAttr("checked");
//                    $('#tblHostAmountTemp').val('');
//                // SPONSORSHIP LEVELS
//                    $('#speakerSponsor').removeAttr("checked");
//                    $('#platinumSponsor').removeAttr("checked");
//                    $('#goldSponsor').removeAttr("checked");
//                    $('#silverSponsor').removeAttr("checked");
//                    $('#bronzeSponsor').removeAttr("checked");
//                // SPONSORSHIP CONTACT ---------------------------------------------------------------------------------------------------------------
//                // DONATIONS -------------------------------------------------------------------------------------------------------------------------
//                // RAFFLE TICKETS AND TRIBUTES OK AS THEY ARE SHARED ---------------------------------------------------------------------------------
//
//            }
        });

//        $('input[type="radio"]').click(function(){
//                if ($(this).is(':checked'))
//                {
//                    alert($(this).val());
//                }
//        });
        if($('#sponsorLevelTemp').val() == '') {
            $('#selectSponsor').click(function(){
                $('input[name="sponsorLevel"]').click(function(){
//                    alert('level1');
                    if(($(this).val() == 'silver') || ($(this).val() == 'bronze')) {
                        $('#contactAddressWrapper').slideDown(300);
                        $('#contactFaxWrapper').slideDown(300);
                        $('#submitContact').hide();
                        $('#submitForm').fadeIn("slow");
                    } else {
                        $('#contactAddressWrapper').slideUp(300);
                        $('#contactFaxWrapper').slideUp(300);
                        $('#submitContact').fadeIn("slow");
                        $('#submitForm').hide();
                    }
                });
            });
        } else {
            $('input[name="sponsorLevel"]').click(function(){
                if(($(this).val() == 'silver') || ($(this).val() == 'bronze')) {
                    $('#contactAddressWrapper').slideDown(300);
                    $('#contactFaxWrapper').slideDown(300);
                    $('#submitContact').hide();
                    $('#submitForm').fadeIn("slow");
                } else {
                    $('#contactAddressWrapper').slideUp(300);
                    $('#contactFaxWrapper').slideUp(300);
                    $('#submitContact').fadeIn("slow");
                    $('#submitForm').hide();
                }
            });
        }





        //= FIELD MASKS ==================================================================================================================================
        $("#conZip").mask("99999");
        $("#conPhone").mask("(999) 999-9999");
        $("#conFax").mask("(999) 999-9999");

        $("#billingZip").mask("99999");
        $("#billingPhone").mask("(999) 999-9999");

    //= MASK CURRENCY ==========================================================================
        $('#tribute1').maskMoney();
        $('#tribute2').maskMoney();
        $('#tribute3').maskMoney();
        $('#tribute4').maskMoney();
        $('#donateAmt').maskMoney();


    //= CREDIT CARD IMAGE DIMMER

        $('#ccNum').change(function(e){
//    		alert(this.value.slice(0,2));
            if(/^4/.test(this.value.slice(0, 2))) {							//=CHECK FOR VISA
                $('#ccBox').css('background-position', '0 -23px');
                $('#ccType').val('v');
            } else if (/^5[1-5]/.test(this.value.slice(0, 2))) {
                $('#ccBox').css('background-position', '0 -46px');
                $('#ccType').val('m');
            } else if (/^3[47]/.test(this.value.slice(0, 2))) {
                $('#ccBox').css('background-position', '0 -69px');
                $('#ccType').val('a');
            } else if (/^6(?:011)/.test(this.value.slice(0, 4))) {
                $('#ccBox').css('background-position', '0 -92px');
                $('#ccType').val('d');
            } else if (/^6(?:5)/.test(this.value.slice(0, 2))) {
                $('#ccBox').css('background-position', '0 -92px');
                $('#ccType').val('d');
            } else {$('#ccBox').css('background-position', '0 0');	}
            $('#ccType').val('');
        });



        $('#sponsorTooltip1').tooltipster({
            animation: 'grow',
            theme: 'tooltipster-wdl',
            trigger: 'click',
            position:'right',
            offsetX: 5,
            //offsetY: 5,
            contentAsHTML: true,
            maxWidth: 420,
            content: presentingSponsorCopy
            //content: $('<div><strong>Presenting Sponsor</strong><ul style="margin-left:20px;"><li><strong>This text is in bold case !</strong></li><li>This Text Isn\'t</li></div>')
        });
        $('#sponsorTooltip2').tooltipster({
            animation: 'grow',
            theme: 'tooltipster-wdl',
            trigger: 'click',
            position:'right',
            offsetX: 5,
            //offsetY: 5,
            contentAsHTML: true,
            maxWidth: 420,
            content: speakerSponsorCopy
        });
        $('#sponsorTooltip3').tooltipster({
            animation: 'grow',
            theme: 'tooltipster-wdl',
            trigger: 'click',
            position:'right',
            offsetX: 5,
            //offsetY: 5,
            contentAsHTML: true,
            maxWidth: 420,
            content: platinumSponsorCopy
        });
        $('#sponsorTooltip4').tooltipster({
            animation: 'grow',
            theme: 'tooltipster-wdl',
            trigger: 'click',
            position:'right',
            offsetX: 5,
            //offsetY: 5,
            contentAsHTML: true,
            maxWidth: 420,
            content: goldSponsorCopy
        });
        $('#sponsorTooltip5').tooltipster({
            animation: 'grow',
            theme: 'tooltipster-wdl',
            trigger: 'click',
            position:'right',
            offsetX: 5,
            //offsetY: 5,
            contentAsHTML: true,
            maxWidth: 420,
            content: silverSponsorCopy
        });
        $('#sponsorTooltip6').tooltipster({
            animation: 'grow',
            theme: 'tooltipster-wdl',
            trigger: 'click',
            position:'right',
            offsetX: 5,
            //offsetY: 5,
            contentAsHTML: true,
            maxWidth: 420,
            content: bronzeSponsorCopy
        });


        $(window).keypress(function() {
            $('#sponsorTooltip1').tooltipster('hide');
            $('#sponsorTooltip2').tooltipster('hide');
            $('#sponsorTooltip3').tooltipster('hide');
            $('#sponsorTooltip4').tooltipster('hide');
            $('#sponsorTooltip5').tooltipster('hide');
            $('#sponsorTooltip6').tooltipster('hide');
        });

        $('input[name=billingSame]').change(function() {
            if($('input[name=billingSame]').prop('checked')) {
                $('#billingFName').val($('#conFName').val());
                $('#billingLName').val($('#conLName').val());
                $('#billingAddress').val($('#conAddress').val());
                $('#billingCity').val($('#conCity').val());
                $('#billingState').val($('#conState').val());
                $('#billingZip').val($('#conZip').val());
                $('#billingPhone').val($('#conPhone').val());
                $('#billingEmail').val($('#conEmail').val());
            } else {
                $('#billingFName').val('');
                $('#billingLName').val('');
                $('#billingAddress').val('');
                $('#billingCity').val('');
                $('#billingState').prop('selectedIndex',0);
                $('#billingZip').val('');
                $('#billingPhone').val('');
                $('#billingEmail').val('');
            }
        });



	});


// FUNCTION TO RESTRICT FIELD IN INPUT TO ONLY NUMBERS AND SPECIAL CHARACTERS.
// 1 ALLOWS NUMBERS AND PERIODS ONLY.
// 2 ALLOWS NUMBERS AND DASHES ONLY.
// 3 ALLOWS NUMBERS, PERIODS (46) AND DASHES (45)
// 4 ALLOWS ONLY NUMBERS.
// 5 ALLOWS NUMBERS, PERIODS (46) AND COMMAS (44)
    function onlyNumbers(evt,negs)
    {
        var e = evt || window.event; // for trans-browser compatibility
        var charCode = e.which || e.keyCode;
        if (negs == 1) {
            if ((charCode < 48 || charCode > 57) & (charCode != 46))
                return false;
        } else if (negs == 2) {
            if ((charCode < 48 || charCode > 57) & (charCode != 45))
                return false;
        } else if (negs == 3) {
            if ((charCode < 48 || charCode > 57) & (charCode != 45) & (charCode != 46))
                return false;
        } else if (negs == 5) {
            if ((charCode < 48 || charCode > 57) & (charCode != 44) & (charCode != 46))
                return false;
        } else if (negs = 4) {
            if (charCode < 48 || charCode > 57)
                return false;
        } else {
            if (charCode < 48 || charCode > 57)
                return false;
        }
        return true;
    }


function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}


////- FUNCTION CREATES A MODAL WINDOW FOR USE WITH PRINTING RECIEPTS FOR EVENTS ------------------------------------------------------------------------
    function modalWin(theTest) {
        if (window.showModalDialog) {
            window.showModalDialog("print.php?print="+theTest,"name", "dialogWidth:520px;dialogHeight:475px;resizable:no;unadorned:yes;");
        } else {
            window.open('print.php?print='.theTest,'name', 'height=475,width=520,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
        }
    }
