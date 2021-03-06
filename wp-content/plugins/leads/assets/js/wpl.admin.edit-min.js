jQuery(document).ready(function () {
    jQuery(".row-actions").each(function () {
        var e = jQuery(this), t = e.parent().parent().find(".column-first-name");
        if (!t.html())return;
        e.appendTo(t)
    });
    jQuery(".touchpoint-value").each(function () {
        var e = jQuery(this).text();
        e != "0" && jQuery(this).parent().show();
        jQuery(this).find(".touchpoint-minute").show()
    });
    var e = jQuery("#touch-point span:visible").length, t = jQuery("#session-time-since:visible").length;
    e === 0 && jQuery("#touch-point").html("<strong>Moments ago</strong>");
    t === 0 && jQuery("#session-time-since").text("Just Now!");
    jQuery("#submitdiv .hndle").text("Update Lead Information");
    var n = '<a class="add-new-h2" href="edit.php?post_type=wp-lead">Back</a>';
    jQuery(".add-new-h2").before(n);
    jQuery(".wpleads-country-dropdown").val(jQuery("#hidden-country-value").val());
    jQuery(".add-new-link").on("click", function (e) {
        var t = jQuery("#wpleads_websites-container .wpleads_link").size(), n = t + 1, r = '<input name="wpleads_websites[' + t + ']" class="wpleads_link" type="text" size="70" value="" />';
        jQuery("#wpleads_websites-container").append(r)
    });
    jQuery(".wpleads_remove_link").live("click", function (e) {
        var t = jQuery(this).attr("id");
        jQuery("#wpleads_websites-" + t).remove()
    });
    jQuery("#wpleads_main_container input").each(function () {
        jQuery(this).val() && jQuery(this).parent().parent().show();
        jQuery(this).val() || jQuery(this).parent().parent().hide().addClass("hidden-lead-fields")
    });
    jQuery("#wpleads-td-wpleads_websites").hasClass("hidden-lead-fields") && jQuery(".wpleads_websites").hide().addClass("hidden-lead-fields");
    jQuery("#show-hidden-fields").click(function () {
        jQuery(".hidden-lead-fields").toggle();
        jQuery("#add-notes").hide()
    });
    var r = jQuery("#wpleads-td-wpleads_notes").text();
    if (r === "") {
        jQuery("#wpleads-td-wpleads_notes textarea").hide().addClass("hidden-lead-fields");
        var i = "<span id='add-notes'>No Notes. Click here to add some.</span>";
        jQuery(i).appendTo(jQuery("#wpleads-td-wpleads_notes"))
    }
    jQuery("#add-notes").click(function () {
        jQuery("#wpleads-td-wpleads_notes textarea").toggle();
        jQuery("#add-notes").hide()
    });
    jQuery(".conversion-tracking-header").on("click", function (e) {
        var t = jQuery(this).find(".toggle-conversion-list"), n = jQuery(this).parent().find(".leads-visit-list, .session-stats").toggle();
        jQuery(n).is(":visible") ? t.text("-") : t.text("+")
    });
    var s = jQuery("#timestamp").html().replace("Published", "Created");
    jQuery("#timestamp").html(s);
    var o = jQuery(".marker").size(), u = jQuery(".wpleads-conversion-tracking-table").size(), a = jQuery("#conversion-total").text(), f = jQuery("#p-view-total").text();
    f === "" && jQuery("#p-view-total").text(o);
    var a = jQuery("#conversion-total").text();
    a === "" && jQuery("#conversion-total").text(u);
    jQuery("h2 .nav-tab").eq(0).css("margin-left", "10px");
    jQuery("#message.updated").text("Lead Updated").css("padding", "10px");
    jQuery(".wpleads-conversion-tracking-table").each(function () {
        var e = jQuery(this).find(".lp-page-view-item").size();
        jQuery(this).find("#pages-view-in-session").text(e);
        if (e == 1) {
            jQuery(this).find(".session-stats-header").hide();
            jQuery(this).find("#session-pageviews").hide()
        }
    });
    jQuery(".view-this-lead-session a").on("click", function (e) {
        var t = jQuery(this).attr("rel"), n = ".session_id_" + t;
        console.log(n);
        jQuery(".conversion-session-view").hide();
        jQuery(n).show()
    });
    var l = jQuery('<select style="display:none" name="NOA" class="id_NOA"></select>');
    jQuery("#raw-data-display").prepend(l);
    jQuery(".wpleads-th label").each(function (e) {
        new_loop_val = e + 1;
        var t = jQuery(this).parent().parent().attr("class"), n = t.replace(" hidden-lead-fields", "");
        field_name_dirty = jQuery(this).text();
        var r = field_name_dirty.replace(":", ""), i = r.replace("/", "");
        jQuery(".id_NOA").append("<option value='" + n + "'>" + i + "</option>")
    });
    jQuery(".map-raw-field").on("click", function (e) {
        var t = jQuery(this).parent().find(".possible-map-value").size(), n = jQuery(this).parent().find(".toggle-val").size();
        console.log(n);
        if (n === 1) {
            jQuery(".toggle-val").addClass("re-do").removeClass("toggle-val");
            jQuery(".re-do").addClass("toggle-val").removeClass("re-do")
        }
        t === 1 && jQuery(this).parent().find(".possible-map-value").addClass("toggle-val");
        jQuery(".map-active-class").removeClass("map-active-class");
        jQuery(this).find(".apply-map").show();
        jQuery(this).prepend(l);
        jQuery(l).show();
        jQuery(".map-hide").show();
        jQuery(this).addClass("map-active-class")
    });
    jQuery(".possible-map-value").on("click", function (e) {
        jQuery(".toggle-val").removeClass("toggle-val");
        jQuery(this).toggleClass("toggle-val")
    });
    var h = jQuery("#current-lead-status").text();
    if (h === "") {
        var p = jQuery("#post_ID").val();
        jQuery.ajax({
            type: "POST",
            url: wp_lead_map.ajaxurl,
            context: this,
            data: {action: "wp_leads_auto_mark_as_read", page_id: p, nonce: c},
            success: function (e) {
                var t = this, n = '<span class="success-message-map" style="display: inline-block;margin-top: -1px;margin-left: 20px;padding:4px 25px 4px 20px;position: absolute;">This Lead has been marked as read/viewed.</span>', r = jQuery("#lead-top-area");
                jQuery(n).appendTo(r)
            },
            error: function (e, t, n) {
                alert("Error thrown not sure why")
            }
        })
    }
});