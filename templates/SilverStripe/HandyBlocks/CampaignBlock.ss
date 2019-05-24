<% cached 'CampaignBlock', $ID, $LastEdited, $ButtonLink.LastEdited, $SecondaryLink.LastEdited %>
    <% if not $Image %>
        <div class="grid">
    <% end_if %>
    <div class="campaign-block block<% if $Image && $ImagePosition = 'Right' %> campaign-block--right<% end_if %><% if not $Image %> campaign-block--no-image<% end_if %>">
        <% if $Image %>
            <div class="campaign-block__image-wrap">
                <img class="campaign-block__image" src="$Image.URL" alt="$Image.Title" />
            </div>
        <% end_if %>
        <div class="campaign-block__wrap">
            <% if $UppercaseTitle %>
                <h5 class="campaign-block__heading">$UppercaseTitle</h5>
            <% end_if %>

            <% if $ShowTitle %>
                <h2 class="campaign-block__title">$Title</h2>
            <% end_if %>
            <p class="campaign-block__summary">$SummaryText</p>

            <% if $ButtonLink %>
                $ButtonLink.setCSSClass('btn campaign-block__button campaign-block__link')
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
