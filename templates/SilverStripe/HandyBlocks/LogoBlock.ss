<% cached 'LogoBlock', $ID, $LastEdited, $Logos.count(), $Logos.max('LastEdited') %>
    <div class="block logo-block">
        <% if $ShowTitle %>
            <h2 class="logo-block__title h3">
                $Title
            </h2>
        <% end_if %>
        <div class="logo-block__logos">
            <% loop $Logos %>
                <% if $Link %>
                    <a href="$Link.LinkURL" class="logo-block__link" $Link.TargetAttr>
                        <img src="$Image.ScaleMaxHeight(100).URL" class="logo-block__image" alt="$Title" />
                    </a>
                <% else %>
                    <span class="logo-block__link">
                        <img src="$Image.ScaleMaxHeight(100).URL" class="logo-block__image" alt="$Title" />
                    </span>
                <% end_if %>
            <% end_loop %>
        </div>
    </div>
<% end_cached %>
