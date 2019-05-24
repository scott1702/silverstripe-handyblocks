<% cached 'CampaignBlock', $ID, $LastEdited, $ButtonLink.LastEdited, $SecondaryLink.LastEdited %>
    <% if not $Image %>
        <div class="grid">
    <% end_if %>
    <div class="campaign-block block<% if $Image && $ImagePosition = 'Right' %> campaign-block--right<% end_if %><% if not $Image %> campaign-block--no-image<% end_if %>">
        <% if $Image %>
            <img class="campaign-block__mobile-image" src="$Image.URL" alt="$Image.Title" />
            <div class="campaign-block__image" style="background-image: url('{$Image.URL}')" aria-label="$Image.Title" role="image"></div>
        <% end_if %>
        <div class="campaign-block__wrap">
            <% if $UppercaseTitle %>
                <p class="campaign-block__heading">$UppercaseTitle</p>
            <% end_if %>

            <% if $ShowTitle %>
                <h2 class="campaign-block__title">$Title</h2>
            <% end_if %>
            <p class="campaign-block__summary">$SummaryText</p>

            <% if $ButtonLink %>
                <% if $StyleVariant == 'light-blue' || $StyleVariant == 'blue' || $StyleVariant == 'pink' %>
                    $ButtonLink.setCSSClass('btn campaign-block__button')
                <% else %>
                    $ButtonLink.setCSSClass('btn campaign-block__button')
                <% end_if %>
            <% end_if %>
            <% if $SecondaryLink %>
                $SecondaryLink.setCSSClass('campaign-block__secondary-link')
            <% end_if %>
        </div>
    </div>
    <% if not $Image %>
        </div>
    <% end_if %>
<% end_cached %>
