<% cached 'CaseStudyBlock', $ID, $LastEdited, $CaseStudyLink.LastEdited, $SecondaryLink.LastEdited %>
    <div class="case-study-block block <% if $ImagePosition = 'Left' %>case-study-block--left<% end_if %>">
        <div class="case-study-block__wrap">
            <p class="case-study-block__heading">Case Study</p>
            <% if $Logo %>
                <img src="$Logo.ScaleMaxWidth(282).URL" alt="$Logo.Title" class="case-study-block__logo"/>
            <% end_if %>

            <% if $ShowTitle %>
                <h2 class="case-study-block__title h1">$Title</h2>
            <% end_if %>
            <p class="case-study-block__intro lead">$Intro</p>

            <% if $CaseStudyLink %>
                <p class="case-study-block__link">$CaseStudyLink.setCSSClass('btn btn--primary')</p>
            <% end_if %>
            <% if $SecondaryLink %>
                <p class="case-study-block__secondary-link">$SecondaryLink</p>
            <% end_if %>
        </div>
        <div class="case-study-block__image-wrap">
            <% if $CaseStudyLink %><a href="$CaseStudyLink.LinkURL"><% end_if %>
                <picture>
                    <source srcset="$Image.ScaleMaxWidth(1977).URL" media="(min-width: 992px)" />
                    <source srcset="$Image.ScaleMaxWidth(1080).URL" media="(max-width: 991px)" />
                    <img src="$Image.URL" alt="$Image.Title"/>
                </picture>
            <% if $CaseStudyLink %></a><% end_if %>
        </div>
    </div>
<% end_cached %>
